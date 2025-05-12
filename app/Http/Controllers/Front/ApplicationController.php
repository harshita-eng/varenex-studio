<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Redirect, Session, Auth, Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Applications;
use App\Models\Departments;
use App\Models\UserRoles;
use App\Models\CompanyAdminDetails;
use App\Models\CompanyBillingDetails;
use App\Models\CompanyContacts;
use App\Models\CompanyDetails;
use App\Models\CompanyDocuments;
use App\Models\CompanyNames;
use App\Models\CompanySchemas;
use App\Models\CompanySettings;
use App\Models\CompanyWorkflows;
use App\Models\DynamicModel;
use App\Models\templates;
use App\Models\templateTables;
use App\Models\TemplateTableFields;
use Illuminate\Support\Facades\Storage;
use App\Services\TableSchemaService;

class ApplicationController extends Controller
{
    protected $tableSchemaService;
    protected $path = 'er-schema.json';
    protected $allTables;
    protected $tables = [];


    public function __construct(TableSchemaService $tableSchemaService)
    {
        $this->tableSchemaService = $tableSchemaService;
        $this->allTables = $this->getAllTableNames();
    }

    private function getAllTableNames(): array
    {
        $auth = (Auth::check()) ? Auth::user()->id : '';
        if(Auth::check()) {
            $appname = CompanyNames::where('user_id', $auth)->select('database_name')->first();
            $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = ?", [$appname['database_name']]);
            return $tables;
        } else {
            return [];
        }
    }
            
    public function option() {

        return view('Front.Application.option');
    }

    public function appForm($type) 
    {
        if($type == 'scratch') {
            return view('Front.Application.scratch');
        } else {
            return view('Front.Application.existing');
        }
    }

    public function showOnboardForm() 
    {
        if (Storage::exists($this->path)) {
            $json = Storage::get($this->path);
        } else {
            $json = json_encode([
                "tables" => [
                    ["id"=>"users","name"=>"users","x"=>50,"y"=>50,
                     "columns"=>[
                       ["id"=>"users.id","name"=>"id","type"=>"INT","primary"=>true],
                       ["id"=>"users.name","name"=>"name","type"=>"VARCHAR(255)","primary"=>false],
                     ]
                    ],
                    ["id"=>"posts","name"=>"posts","x"=>350,"y"=>50,
                     "columns"=>[
                       ["id"=>"posts.id","name"=>"id","type"=>"INT","primary"=>true],
                       ["id"=>"posts.user_id","name"=>"user_id","type"=>"INT","primary"=>false],
                       ["id"=>"posts.content","name"=>"content","type"=>"TEXT","primary"=>false],
                     ]
                    ],
                ],
                "relationships" => [
                    ["from"=>"users.id","to"=>"posts.user_id"]
                ]
            ], JSON_PRETTY_PRINT);
        }
        return view('Front.Onboard.onboard', ['erJson' => $json]);
    }

    public function onboardSubmit(Request $request) 
    {
        $request = $request->all(); //dd($request);
        $json = Storage::get($this->path); //dd($json);

        if(!empty($request)) 
        {            
            $appName = str_replace(" ","_",strtolower($request['app_name']));
            $data = CompanyNames::where('name', $request['app_name'])->first();
            if(!empty($data)) 
            {
                Session::flash('message', 'Application name already taken. Please enter a different name !'); 
                return Redirect::back();
            } else {

                // save as user 
                $objUser = new User;
                $objUser->name     = isset($request['admin_name']) ? $request['admin_name'] : '';
                $objUser->email    = isset($request['admin_email']) ? $request['admin_email'] : '';
                $objUser->password = isset($request['admin_password']) ? Hash::make($request['admin_password']) : '';
                $objUser->role_id = 2;
                $objUser->save();
                Auth::login($objUser);

                $obj = new CompanyNames;
                $obj->user_id = $objUser->id;
                $obj->name = $request['app_name'];
                $obj->source_type = isset($request['source_type']) ? $request['source_type'] : '';
                $obj->database_name	 = $appName;
                $obj->domain = 'http://127.0.0.1:8000/'.$appName;
                $obj->save();
                DB::statement("CREATE DATABASE $appName");
                $department = "
                    CREATE TABLE IF NOT EXISTS"." $appName".".departments (
                        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `status` VARCHAR(50) COLLATE utf8_general_ci,
                        `created_at` TIMESTAMP NULL,
                        `updated_at` TIMESTAMP NULL
                    ) ENGINE=InnoDB
                    DEFAULT CHARSET=utf8mb4
                    COLLATE=utf8mb4_general_ci;
                ";
                DB::statement($department);

                $roles = "
                    CREATE TABLE IF NOT EXISTS"." $appName ".".roles (
                        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        `department_id` INT,
                        `roles` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `permission` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `status` VARCHAR(50) COLLATE utf8_general_ci,
                        `created_at` TIMESTAMP NULL,
                        `updated_at` TIMESTAMP NULL
                    ) ENGINE=InnoDB
                    DEFAULT CHARSET=utf8mb4
                    COLLATE=utf8mb4_general_ci;
                ";
                DB::statement($roles);
                
                $user = "
                    CREATE TABLE IF NOT EXISTS"." $appName".".users (
                        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        `department_id` INT,
                        `name` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `email` VARCHAR(180) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `role` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `status` VARCHAR(50) COLLATE utf8_general_ci,
                        `created_at` TIMESTAMP NULL,
                        `updated_at` TIMESTAMP NULL
                    ) ENGINE=InnoDB
                    DEFAULT CHARSET=utf8mb4
                    COLLATE=utf8mb4_general_ci;
                ";
                DB::statement($user);

                //create db tables

                if($request['source_type'] == 'scratch') {

                    $gallery = $this->scratch($appName, $request['items']);
                } 

                else if ($request['source_type'] == 'gallery') {

                    $gallery = $this->gallery($appName, $request['items']);
                }  

                else if ($request['source_type'] == 'csv') {

                    $gallery = $this->csvExport($appName, $request['import_csv']); 
                } 
                
                // company details
                $objDetials = new CompanyDetails;
                $objDetials->user_id = $objUser->id;
                $objDetials->company_name = isset($request['company_name']) ? $request['company_name'] : '';
                $objDetials->director_name = isset($request['director_name']) ? $request['director_name'] : '';
                $objDetials->industry = isset($request['industry']) ? $request['industry'] : '';
                $objDetials->company_size = isset($request['company_size']) ? $request['company_size'] : '';
                $objDetials->website = isset($request['website']) ? $request['website'] : '';
                if($request['logo'] != '') 
                {
                    $imageName = time().'.'.request()->logo->getClientOriginalExtension(); 
                    $path = request()->logo->move(public_path('companies/'.$appName), $imageName);
                    $objDetials->logo = $imageName;
                }
                $objDetials->save();

                // company contact & settings
                $objContacts = new CompanyContacts;
                $objContacts->company_id = $obj->id;
                $objContacts->address_1 = isset($request['address1']) ? $request['address1'] : '';
                $objContacts->address_2 = isset($request['address2']) ? $request['address2'] : '';
                $objContacts->city      = isset($request['city']) ? $request['city'] : '';
                $objContacts->state     = isset($request['state']) ? $request['state'] : '';
                $objContacts->zip       = isset($request['zip']) ? $request['zip'] : '';
                $objContacts->country   = isset($request['country']) ? $request['country'] : '';
                $objContacts->phone     = isset($request['phone']) ? $request['phone'] : '';
                $objContacts->email     = isset($request['email']) ? $request['email'] : '';
                $objContacts->save();

                // company Admin Details
                $objAdmin = new CompanyAdminDetails;
                $objAdmin->company_id  = $obj->id;
                $objAdmin->admin_name  = isset($request['admin_name']) ? $request['admin_name'] : '';
                $objAdmin->admin_email = isset($request['admin_email']) ? $request['admin_email'] : '';
                $objAdmin->admin_phone = isset($request['admin_phone']) ? $request['admin_phone'] : '';
                $objAdmin->admin_role  = isset($request['admin_role']) ? $request['admin_role'] : '';
                $objAdmin->admin_password = isset($request['admin_password']) ? $request['admin_password'] : '';
                $objAdmin->save();

                // company settings
                $objSetting = new CompanySettings;
                $objSetting->company_id  = $obj->id;
                $objSetting->currency  = isset($request['currency']) ? $request['currency'] : '';
                $objSetting->language = isset($request['language']) ? $request['language'] : '';
                $objSetting->communication_preference = isset($request['communication']) ? $request['communication'] : '';
                $objSetting->save();

                // company billing and plans
                // $objPlans = new CompanyBillingDetails;
                // $objPlans->company_id  = '2'; //$obj->id;
                // $objPlans->plan  = isset($request['plan']) ? $request['plan'] : '';
                // $objPlans->billing_address = isset($request['billing_address']) ? $request['billing_address'] : '';
                // $objPlans->tax_id = isset($request['tax_id']) ? $request['tax_id'] : '';
                // $objPlans->billing_email = isset($request['billing_email']) ? $request['billing_email'] : '';
                // $objPlans->save();

                // company documents
                $objDocs= new CompanyDocuments;
                $objDocs->company_id = $obj->id;
                if(isset($request['busniess_registration']) && $request['busniess_registration'] != '') {
                    $imageName = time().'.'.request()->busniess_registration->getClientOriginalExtension(); 
                    $path = request()->busniess_registration->move(public_path('companies/'.$appName), $imageName);
                    $objDocs->busniess_registration = $imageName;
                }
                if(isset($request['registration_certificate']) && $request['registration_certificate'] != '') {
                    $imageName = time().'.'.request()->registration_certificate->getClientOriginalExtension(); 
                    $path = request()->registration_certificate->move(public_path('companies/'.$appName), $imageName);
                    $objDocs->registration_certificate = $imageName;
                }
                if(isset($request['company_license']) && $request['company_license'] != '') {
                    $imageName = time().'.'.request()->company_license->getClientOriginalExtension(); 
                    $path = request()->company_license->move(public_path('companies/'.$appName), $imageName);
                    $objDocs->company_license = $imageName;
                }
                if(isset($request['director_id']) && $request['director_id'] != '') {
                    $imageName = time().'.'.request()->director_id->getClientOriginalExtension(); 
                    $path = request()->director_id->move(public_path('companies/'.$appName), $imageName);
                    $objDocs->director_id = $imageName;
                }
                if(isset($request['address_proof']) && $request['address_proof'] != '') {
                    $imageName = time().'.'.request()->address_proof->getClientOriginalExtension(); 
                    $path = request()->address_proof->move(public_path('companies/'.$appName), $imageName);
                    $objDocs->address_proof = $imageName;
                }
                $objDocs->save();

                // company departments
                if(count($request['departments']) > 0)
                {
                    foreach($request['departments'] as $key1 => $depart) 
                    {                
                        $departObj = new Departments;
                        $departObj->user_id = 2;
                        $departObj->application_id = 1;
                        $departObj->department_name = $depart['name'];
                        $departObj->save();
                        DB::statement("INSERT INTO $appName"."."."`departments`(`name`) VALUES ('".$depart['name']."')");
                        if(count($depart['roles'] ) > 0) 
                        {
                            foreach($depart['roles'] as $key2 => $roles) 
                            {
                                $roleObj = new UserRoles;
                                $roleObj->department_id = $departObj->id;
                                $roleObj->user_role = $roles['name'];
                                $roleObj->permissions = (isset($roles['permissions'])) ? implode(',', $roles['permissions']) : '';
                                $roleObj->status = 1;
                                $roleObj->save();
                                DB::statement("INSERT INTO $appName"."."."`roles`(`department_id`,`roles`,`permission`) VALUES ('".$departObj->id."','".$roles['name']."','".implode(',', $roles['permissions'])."')");
                            }

                            // users 
                            foreach($depart['users'] as $key3 => $user) 
                            {
                                // $userObj = new UserRoles;
                                // $userObj->department_id = $departObj->id;
                                // $userObj->name   = $user['name'];
                                // $userObj->email  = $user['email'];
                                // $userObj->role   = $user['role'];
                                // $userObj->status = 1;
                                // $userObj->save();
                                DB::statement("INSERT INTO $appName"."."."`users`(`department_id`,`name`,`email`,`role`) VALUES ('".$departObj->id."','".$user['name']."','".$user['email']."', '".$user['role']."')");
                            }
                        }
                    }
                }

                // company workflow
                if(count($request['items']) > 0) {
                    foreach($request['items'] as $val) {
                        $objWorkflow = new CompanyWorkflows;
                        $objWorkflow->company_id = $obj->id;
                        $objWorkflow->workflow = $val;
                        $objWorkflow->save();
                    }
                }

                // company schema 
                $objSchema = new CompanySchemas;
                $objSchema->company_id = $obj->id;
                $objSchema->schemas = Storage::get($this->path);
                $objSchema->save();

                // create tables according to the source type

                return redirect()->route('appdashboard', $appName)->with('success', 'Your onboarding is complete! Welcome aboard — you are all set to get started !');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function save(Request $req)
    {
        $data = $req->validate(['er' => 'required|json']);
        Storage::put($this->path, $data['er']);
        return response()->json(['status'=>'ok']);
    }

    // public function onboardSubmit(Request $request) 
    // {
    //     $request = $request->all(); //dd($request);

    //     if(!empty($request)) 
    //     {
            
    //         $appName = str_replace(" ","_",strtolower($request['app_name']));
    //         $data = CompanyNames::where('name', $request['app_name'])->first();
    //         if(!empty($data)) 
    //         {
    //             Session::flash('message', 'Application name already taken. Please enter a different name !'); 
    //             return Redirect::back();
    //         } else {  
    //             $obj = new CompanyNames;
    //             $obj->company_id = '';
    //             $obj->name = $request['app_name'];
    //             $obj->source_type = isset($request['source_type']) ? $request['source_type'] : '';
    //             $obj->database_name	 = $appName;
    //             $obj->domain = 'http://127.0.0.1:8000/'.$appName;
    //             dd($obj);
    //             $obj->save();
    //             DB::statement("CREATE DATABASE $appName");

    //             // save departments
    //             if(count($request['departments']) > 0)
    //             {
    //                 foreach($request['departments'] as $key1 => $depart) 
    //                 {                
    //                     $departObj = new Departments;
    //                     $departObj->user_id = Auth::user()->id;
    //                     $departObj->application_id = 1;
    //                     $departObj->department_name = $depart['name'];
    //                     $departObj->save();
    //                     if(count($depart['roles'] ) > 0) 
    //                     {
    //                         foreach($depart['roles'] as $key2 => $roles) 
    //                         {
    //                             $roleObj = new UserRoles;
    //                             $roleObj->department_id = $departObj->id;
    //                             $roleObj->user_role = $roles['name'];
    //                             $roleObj->permissions = implode(',', $roles['permissions']);
    //                             $roleObj->status = 1;
    //                             $roleObj->save();
    //                         }
    //                     }
    //                 }
    //             }

    //             // import csv data
                // if(isset($request['import_csv'])) 
                // {
                //     $file   = request()->file('import_csv'); 
                //     $handle = fopen($file->getRealPath(), 'r');
                //     $datasets = [];
                //     $currentSet = null;

                //     while (($line = fgetcsv($handle)) !== false) 
                //     {
                //         if (empty(array_filter($line))) continue; // skip empty lines

                //         if (in_array('id', $line)) {
                //             if ($currentSet) {
                //                 $datasets[] = $currentSet;
                //             }
                //             $currentSet = [
                //                 'headers' => array_map('trim', $line),
                //                 'rows' => [],
                //             ];
                //         } else {
                //             if ($currentSet) {
                //                 $currentSet['rows'][] = $line;
                //             }
                //         }
                //     }

                //     if ($currentSet) {
                //         $datasets[] = $currentSet;
                //     }
                //     fclose($handle);
                    
                //     foreach ($datasets as $index => $dataset) 
                //     {
                //         $headers = $dataset['headers'];
                //         $rows = $dataset['rows'];
                //         $tableName = 'import_table_' . ($index + 1);

                //         if (Schema::hasTable($tableName)) {
                //             return back()->withErrors(['file' => "Table '$tableName' already exists."]);
                //         }
                        
                //         $columnsSql = implode(', ', array_map(function ($col) {
                //             return "`" . preg_replace('/[^a-zA-Z0-9_]/', '_', $col) . "` VARCHAR(255)";
                //         }, $headers));

                //         DB::statement("CREATE TABLE new_erp.`$tableName` (t_id INT AUTO_INCREMENT PRIMARY KEY, $columnsSql)");
                //         foreach ($rows as $row) { 
                //             if (count($row) !== count($headers)) continue;
                //             $data = array_combine($headers, $row);
                //             DB::table($appName.".".$tableName)->insert($data);
                //         }
                //     }
                // }

    //             // scratch
    //             if(isset($request['scratch'])) 
    //             {                    
    //                 $formDetails = json_decode($request['scratch']); 
    //                 $values = [];
    //                 $fields = [];
    //                 if(count($formDetails) > 0) 
    //                 {
    //                     foreach($formDetails as $key => $details) {

    //                         $values[] = $details->value; 
    //                         $fields[] = $details->name; 
    //                     }
                        
    //                     $columnsSql = implode(', ', array_map(function ($col) {
    //                         return "`" . preg_replace('/[^a-zA-Z0-9_]/', '_', $col) . "` VARCHAR(255)";
    //                     }, $fields));

    //                     $colArr  = [];
    //                     $columns = implode(' ', array_map(function ($col) {
    //                         return preg_replace('/[^a-zA-Z0-9_]/', '_', $col);
    //                     }, $fields));
    //                     $colArr =  explode(" ", $columns);

    //                     DB::statement("CREATE TABLE new_erp.table_1 (id INT AUTO_INCREMENT PRIMARY KEY, $columnsSql)");
    //                     $data = array_combine($colArr, $values);
    //                     DB::table('new_erp.table_1')->insert($data);
    //                 }
    //             }
    //             return redirect()->route('home')->with('success', 'Your onboarding is complete! Welcome aboard — you are all set to get started !');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Something went wrong');
    //     }
    // }

    public function appDashboard($appname) {    

        $authId = Auth::user()->id;
        $data['appname'] = strtolower($appname);
        $data['tableList']  = $this->allTables;
        $data['appDetails'] = CompanyNames::where('database_name', $appname)->first();
        $data['appinfo']    = CompanyDetails::where('user_id', $authId)->select('logo')->first();
        $data['logo'] = 'companies/'.$data['appname'].'/'.$data['appinfo']['logo'];

        return view('Front.Application.app_dashboard', $data);
    }

    public function appSettings($appname) {
        
        $tableList = $this->allTables;
        return view('Front.Application.settings', compact('appname','tableList'));
    }

    public function tableListing($table, $appname) {
        
        $model = (new DynamicModel())->setTableName($appname,$table); 
        $columns = $this->tableSchemaService->getTableColumns($table, $appname);
        $list = DB::table($appname.".".$table)->orderBy('id','DESC')->get(); //dd($list);

        $data = [
            'list' => $list,
            'columns' => $columns, 
            'tableList' => $this->allTables,
            'table' => $table,
            'appname' => strtolower($appname), 
            'logo' => '',
        ];
        return view('Front.Application.list', $data);
    }

    public function showTableForm($table, $appname) // appname is the database name also
    {
        //Get column information from the target table
        $columns = $this->tableSchemaService->getTableColumns($table, $appname);
        $exclude = ['id', 'created_at', 'updated_at', 'status'];
        $columns = $columns->filter(function($column) use ($exclude) {
            return !in_array($column->COLUMN_NAME, $exclude);
        });

        $data = [
            'columns' => $columns,
            'table' => $table,
            'appname' => $appname,
            'tableList' => $this->allTables,
            'logo' => '',
        ];
        return view('Front.Application.add', $data);
    }

    public function saveForm(Request $request, $table, $appname) 
    {
        $req = $request->all(); 
        $columns = implode(", ", array_keys($req['value']));
        $placeholders = ":" . implode(", :", array_keys($req['value']));
        $sql = "INSERT INTO $appname".'.'.$table." ($columns) VALUES ($placeholders)";
        $in  = DB::insert($sql, $req['value']);
        if($in == true) {
            return redirect()->route('tablelisting',[$table,$appname])->with('success', 'Data added successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function editShowTableForm($table, $appname, $id) {

        $columns = $this->tableSchemaService->getTableColumns($table, $appname);
        $exclude = ['id', 'created_at', 'updated_at', 'status'];
        $columns = $columns->filter(function($column) use ($exclude) {
            return !in_array($column->COLUMN_NAME, $exclude);
        });

        dd($columns);
        $details = DB::table($appname.'.'.$table)->where('id', decrypt($id))->first();

        dd($columns);
        $data = [
            'table' => $table,
            'appname' => $appname,
            'columns' => $columns,
            'tableList' => $this->allTables,
            'logo' => '',
            'details'=> $details,
            'id'=>$id
        ];

        return view('Front.Application.edit', $data);
    }

    public function viewTableDetails($table, $appname, $id) {

        dd(decrypt($id));
    }

    public function deleteTableDetails($table, $appname, $id) {

        dd(decrypt($id));
    }

    public function  gallery($appname, $workflow) 
    {

        $templates = templates::where('id','1')->select('id','name','status')->first();
        $tempTables = templateTables::where('template_id', $templates['id'])->select('id','template_id','table_name','status')->get();
        $templateFields = TemplateTableFields::whereIn('template_table_id', [1, 2, 3, 4, 5, 6])->get()->toArray();
        $groupedFields = collect($templateFields)->groupBy('template_table_id');

        foreach ($tempTables as $table) 
        {
            $tableName = $table['table_name'];  
            $fields = $groupedFields[$table['id']] ?? collect();

            if ($fields->isEmpty()) continue;

            $columnsSql = [];

            // Optional: Add an `id` column
            $columnsSql[] = "`id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY";

            foreach ($fields as $field) 
            {
                $columnName = $field['column_name'];
                $dataType = strtoupper($field['data_type']); // Ensure uppercase like 'VARCHAR', 'INT'

                // Map to SQL data type with default sizes where needed
                switch ($dataType) {
                    case 'VARCHAR':
                        $columnsSql[] = "`$columnName` VARCHAR(255) NULL";
                        break;
                    case 'INT':
                    case 'INTEGER':
                        $columnsSql[] = "`$columnName` INT NULL";
                        break;
                    case 'TEXT':
                        $columnsSql[] = "`$columnName` TEXT NULL";
                        break;
                    case 'BOOLEAN':
                        $columnsSql[] = "`$columnName` TINYINT(1) DEFAULT 0";
                        break;
                    case 'DATE':
                        $columnsSql[] = "`$columnName` DATE NULL";
                        break;
                    case 'DATETIME':
                        $columnsSql[] = "`$columnName` DATETIME NULL";
                        break;
                    default:
                        $columnsSql[] = "`$columnName` $dataType NULL"; // fallback
                        break;
                }
            }

            // Add timestamps (optional)
            $columnsSql[] = "`created_at` TIMESTAMP NULL DEFAULT NULL";
            $columnsSql[] = "`updated_at` TIMESTAMP NULL DEFAULT NULL";

            // Combine all column definitions
            $columnsString = implode(",\n", $columnsSql); 

            // Final CREATE TABLE query
            $createTableSql = "CREATE TABLE IF NOT EXISTS `$appname`.`$tableName` (\n$columnsString\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            // Execute the query on the secondary database
            DB::statement($createTableSql);
        }
        return 'true';
    }

    public function scratch ($appname, $workflow) 
    {
        $json = Storage::get($this->path);
        if(!empty($json)) 
        {
            $jsonArr = json_decode($json);

            // Check if JSON was decoded properly
            if (is_null($jsonArr)) {
                die("Invalid JSON provided.\n");
            }

            foreach ($jsonArr as $key => $value) {
                // Ensure $value is an array or iterable
                if (!is_array($value)) {
                    echo "Invalid format at key: $key\n";
                    var_dump($value);
                    continue;
                }

                foreach ($value as $tab => $table) {
                    // Ensure $table is an object and has 'name' and 'columns'
                    if (!is_object($table) || !isset($table->name) || !isset($table->columns)) {
                        echo "Skipping invalid table structure at tab: $tab\n";
                        var_dump($table);
                        continue;
                    }

                    $tableName  = $table->name;
                    $columnsSql = [];

                    if (is_array($table->columns) && count($table->columns) > 0) {
                        foreach ($table->columns as $keyCol => $valCol) {
                            // Ensure column has name and type
                            if (!isset($valCol->name) || !isset($valCol->type)) {
                                echo "Skipping invalid column in table $tableName:\n";
                                var_dump($valCol);
                                continue;
                            }

                            $columnLine = "`{$valCol->name}` {$valCol->type}";

                            if (isset($valCol->nullable) && $valCol->nullable === false) {
                                $columnLine .= ' NOT NULL';
                            }

                            if (!empty($valCol->auto_increment)) {
                                $columnLine .= ' AUTO_INCREMENT';
                            }

                            if (isset($valCol->primary) && $valCol->primary === true) {
                                $columnLine .= ' PRIMARY KEY';
                            }

                            $columnsSql[] = $columnLine;
                        }

                        if (!empty($columnsSql)) {
                            $columnsSqlString = implode(", ", $columnsSql); 
                            $fullTableName = "`$appname`.`$tableName`"; 

                            $createSql = DB::statement("CREATE TABLE IF NOT EXISTS $fullTableName ($columnsSqlString) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

                            // Uncomment to run:
                            // DB::statement($createSql);
                            echo "Prepared SQL for $fullTableName:\n$createSql\n\n";
                        }
                    }
                }
            }
        } else {

            return false;
        }
    } 

    public function csvExport($appname, $csv) 
    {
        
        if(isset($csv)) 
        {
            //$file   = request()->file($csv);  
            $handle = fopen($csv->getRealPath(), 'r'); 
            $datasets = [];
            $currentSet = null;

            while (($line = fgetcsv($handle)) !== false) 
            {
                if (empty(array_filter($line))) continue; // skip empty lines

                if (in_array('id', $line)) {
                    if ($currentSet) {
                        $datasets[] = $currentSet;
                    }
                    $currentSet = [
                        'headers' => array_map('trim', $line),
                        'rows' => [],
                    ];
                } else {
                    if ($currentSet) {
                        $currentSet['rows'][] = $line;
                    }
                }
            }

            if ($currentSet) {
                $datasets[] = $currentSet;
            }
            fclose($handle);
            
            foreach ($datasets as $index => $dataset) 
            {
                $headers = $dataset['headers'];
                $rows = $dataset['rows'];
                $tableName = 'import_table_' . ($index + 1);

                if (Schema::hasTable($tableName)) {
                    return back()->withErrors(['file' => "Table '$tableName' already exists."]);
                }
                
                $columnsSql = implode(', ', array_map(function ($col) {
                    return "`" . preg_replace('/[^a-zA-Z0-9_]/', '_', $col) . "` VARCHAR(255)";
                }, $headers));

                DB::statement("CREATE TABLE `$appname`.`$tableName` (t_id INT AUTO_INCREMENT PRIMARY KEY, $columnsSql)");
                foreach ($rows as $row) { 
                    if (count($row) !== count($headers)) continue;
                    $data = array_combine($headers, $row);
                    DB::table($appname.".".$tableName)->insert($data);
                }
            }
        }
        return 'true';
    }
}

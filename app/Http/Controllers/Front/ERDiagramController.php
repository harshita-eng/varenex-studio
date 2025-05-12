<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ERDiagramController extends Controller
{
    
    protected $path = 'er-schema.json';
    
    
    // public function index()
    // {
    //     $dummyData = [
    //         "tables" => [
    //             [
    //                 "id" => "users",
    //                 "name" => "users",
    //                 "columns" => [
    //                     ["name" => "id", "type" => "INT", "primary" => true],
    //                     ["name" => "name", "type" => "VARCHAR(255)"]
    //                 ]
    //             ],
    //             [
    //                 "id" => "posts",
    //                 "name" => "posts",
    //                 "columns" => [
    //                     ["name" => "id", "type" => "INT", "primary" => true],
    //                     ["name" => "user_id", "type" => "INT"],
    //                     ["name" => "content", "type" => "TEXT"]
    //                 ]
    //             ]
    //         ],
    //         "relationships" => [
    //             ["from" => "users.id", "to" => "posts.user_id"]
    //         ]
    //     ];

    //     return view('erd', ['erdData' => $dummyData]);
    // }

    public function index()
    {
        // try {
        //     DB::connection('mysql_remote')->getPdo();
        //     echo "Connection to azure database successful!".'</br> dbname - ';
        //     return DB::connection('mysql_remote')->getDatabaseName();
        // } catch (\Exception $e) {
        //     echo "Connection failed: " . $e->getMessage();
        //     //dd($e);
        //     // Log::error($e); // Optional: log the error
        // }
        // die();
        // load JSON from storage (or fall back to dummy)
        // if (Storage::exists($this->path)) {
        //     $json = Storage::get($this->path);
        // } else {
        //     $json = json_encode([
        //         "tables" => [
        //             ["id"=>"users","name"=>"users","x"=>50,"y"=>50,
        //              "columns"=>[
        //                ["id"=>"users.id","name"=>"id","type"=>"INT","primary"=>true],
        //                ["id"=>"users.name","name"=>"name","type"=>"VARCHAR(255)","primary"=>false],
        //              ]
        //             ],
        //             ["id"=>"posts","name"=>"posts","x"=>350,"y"=>50,
        //              "columns"=>[
        //                ["id"=>"posts.id","name"=>"id","type"=>"INT","primary"=>true],
        //                ["id"=>"posts.user_id","name"=>"user_id","type"=>"INT","primary"=>false],
        //                ["id"=>"posts.content","name"=>"content","type"=>"TEXT","primary"=>false],
        //              ]
        //             ],
        //         ],
        //         "relationships" => [
        //             ["from"=>"users.id","to"=>"posts.user_id"]
        //         ]
        //     ], JSON_PRETTY_PRINT);
        // }

        //step1 : fetch table schema from database through query
        $tableName = ['users', 'applications', 'departments'];
        $placeholders = implode(',', array_fill(0, count($tableName), '?'));
        $query = "
            SELECT 
                TABLE_NAME,
                COLUMN_NAME,
                DATA_TYPE,
                IS_NULLABLE,
                COLUMN_KEY,
                COLUMN_DEFAULT
            FROM information_schema.columns
            WHERE table_schema = ?
            AND table_name IN ($placeholders)
            ORDER BY TABLE_NAME, ORDINAL_POSITION
        ";
        $params = array_merge([env('DB_DATABASE')], $tableName);
        $schemaDetails = DB::select($query, $params);

        // step2: fetch fk for all the above table schema
        $fkQuery = "
            SELECT 
                TABLE_NAME,
                COLUMN_NAME,
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = ?
            AND TABLE_NAME IN ($placeholders)
            AND REFERENCED_TABLE_NAME IS NOT NULL";
            $fkData = DB::select($fkQuery, $params);

        // step3 : group all the schema on basis of table
        $grouped = collect($schemaDetails)->groupBy('TABLE_NAME');

        // step4 : create table for tables and columns
        $tables = [];
        foreach ($grouped as $tableName => $columns) {
            $tables[] = [
                "id" => $tableName,
                "name" => $tableName,
                "x" => 50, // you can randomize or auto-layout later
                "y" => 50,
                "columns" => collect($columns)->map(function ($col) use ($tableName) {
                    return [
                        "id" => "{$tableName}.{$col->COLUMN_NAME}",
                        "name" => $col->COLUMN_NAME,
                        "type" => strtoupper($col->DATA_TYPE),
                        "primary" => $col->COLUMN_KEY === 'PRI'
                    ];
                })->toArray()
            ];
        }

        // step5 : build relationships
        $relationships = collect($fkData)->map(function ($fk) {
            return [
                "from" => "{$fk->REFERENCED_TABLE_NAME}.{$fk->REFERENCED_COLUMN_NAME}",
                "to" => "{$fk->TABLE_NAME}.{$fk->COLUMN_NAME}"
            ];
        })->toArray();

        // step6: final json
        $json = json_encode([
            "tables" => $tables,
            "relationships" => $relationships
        ], JSON_PRETTY_PRINT);


        return view('erd', ['erJson' => $json]);
    }

    public function save(Request $req)
    {
        $data = $req->validate(['er' => 'required|json']);
        Storage::put($this->path, $data['er']);
        return response()->json(['status'=>'ok']);
    }

    public function test() {

        return view('test');
    }
}

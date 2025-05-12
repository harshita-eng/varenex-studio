<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;


class TableSchemaService
{
    /**
     * Fetch columns of a table dynamically from the database schema
     * 
     * @param string $table The table name
     * @return \Illuminate\Support\Collection
    */
    public function getTableColumns($table, $database)
    {
        return DB::table('information_schema.columns')
        ->select('COLUMN_NAME','DATA_TYPE')
        ->where('table_schema', $database)
        ->where('table_name', $table)
        ->get();
    }
}

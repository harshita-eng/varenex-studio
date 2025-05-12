<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicModel extends Model
{
    protected $table;
    public $timestamps = false;

    public function setTableName($database, $table)
    {
        $this->table = $database . '.' . $table;  // No backticks!
        return $this;
    }
}
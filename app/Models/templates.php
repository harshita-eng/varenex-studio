<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class templates extends Model
{
    public function getTemplateTables() {

        return $this->hasOne(templateTables::class);
    }


    
}

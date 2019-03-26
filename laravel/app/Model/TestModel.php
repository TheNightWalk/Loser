<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $table = "catenate";
    protected $primaryKey = "catenate_id";
    public $timestamps = false;
}

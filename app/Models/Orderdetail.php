<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table='db_orderdetail'; 
}

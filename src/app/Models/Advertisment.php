<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable= ['name','price','description','main_cover','links'];
}

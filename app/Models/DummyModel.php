<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyModel extends Model
{
    use HasFactory;
    protected $table = 'dummy';
    protected $primaryKey = 'dummyid';
    protected $fillable = ['image', 'title'];
}

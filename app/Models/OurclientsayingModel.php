<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurclientsayingModel extends Model
{
    use HasFactory;
    protected $table = 'ourclientsaying';
    protected $primaryKey = 'ourclientsaying_id';
    protected $fillable = ['description', 'image', 'title', 'position'];
}

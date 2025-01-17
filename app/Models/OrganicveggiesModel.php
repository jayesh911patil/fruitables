<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganicveggiesModel extends Model
{
    use HasFactory;
    protected $table = 'organicveggies';
    protected $primaryKey = 'Organicveggies_id';
    protected $fillable = ['image', 'title'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityModel extends Model
{
    use HasFactory;
    protected $table = 'facility';
    protected $primaryKey = 'facility_id';
    protected $fillable = ['image', 'title', 'description'];
}

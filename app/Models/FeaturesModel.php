<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesModel extends Model
{
    use HasFactory;
    protected $table = 'features';
    protected $primaryKey = 'features_id';
    protected $fillable = ['image', 'title', 'description'];
}

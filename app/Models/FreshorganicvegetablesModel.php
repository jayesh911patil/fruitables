<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreshorganicvegetablesModel extends Model
{
    use HasFactory;
    protected $table = 'freshorganicvegetables';
    protected $primaryKey = 'freshorganicvegetables_id';
    protected $fillable = ['tag', 'image', 'title', 'description', 'price'];
}

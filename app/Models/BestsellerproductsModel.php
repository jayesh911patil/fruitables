<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestsellerproductsModel extends Model
{
    use HasFactory;
    protected $table = 'bestsellerproducts';
    protected $primaryKey = 'bestsellerproducts_id';
    protected $fillable = ['image', 'title', 'price'];
}

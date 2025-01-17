<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurorganicproductsModel extends Model
{
    use HasFactory;
    protected $table = 'ourorganicproducts';
    protected $primaryKey = 'ourorganicproducts_id';
    protected $fillable = ['image', 'title', 'description', 'price', 'tag'];
}

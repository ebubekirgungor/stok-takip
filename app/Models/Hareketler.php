<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hareketler extends Model
{
    use HasFactory;
		protected $table = 'hareketler';
		public $timestamps = false;
		protected $guarded = ['id'];
}
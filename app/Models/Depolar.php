<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depolar extends Model
{
    use HasFactory;
		protected $table = 'depolar';
		public $timestamps = false;
		protected $guarded = ['id'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birimler extends Model
{
    use HasFactory;
		protected $table = 'birimler';
		public $timestamps = false;
		protected $guarded = ['id'];
}
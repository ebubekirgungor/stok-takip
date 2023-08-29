<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stoklar extends Model
{
    use HasFactory;
		protected $table = 'stoklar';
		public $timestamps = false;
		protected $guarded = ['id'];
}
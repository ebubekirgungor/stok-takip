<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Islem_tipleri extends Model
{
    use HasFactory;
		protected $table = 'islem_tipleri';
		public $timestamps = false;
		protected $guarded = ['id'];
}
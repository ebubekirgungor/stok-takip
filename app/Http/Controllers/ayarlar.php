<?php

namespace App\Http\Controllers;

use App\Models\Birimler;
use App\Models\Depolar;
use App\Models\Islem_tipleri;

use Illuminate\Http\Request;

class ayarlar extends Controller
{
    public function index()
    {
        $birimler = Birimler::all();
        $depolar = Depolar::all();
        $islem_tipleri = Islem_tipleri::all();
				return view('sayfalar/ayarlar', compact('birimler','depolar','islem_tipleri'));
    }
}

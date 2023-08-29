<?php

namespace App\Http\Controllers;

use App\Models\Stoklar;
use App\Models\Firmalar;
use App\Models\Hareketler;
use App\Models\Islem_tipleri;
use Illuminate\Http\Request;

class genel extends Controller
{
    public function index()
    {
        $stoklar = Stoklar::all()->count();
        $firmalar = Firmalar::all()->count();

        $giris_islem_tipleri = Islem_tipleri::whereIn(
			'islem_tipi', ['Serbest Stok Girişi',
			'Alım İrsaliye Girişi',
			'Satış İade İrsaliyesi',
			'Üretimden Giriş',
			'Konsinye Alım İrsaliyesi'
		])->get();

		$serbest_giris = $giris_islem_tipleri->where('islem_tipi', 'Serbest Stok Girişi')->value('id');
		$alim_irsaliye = $giris_islem_tipleri->where('islem_tipi', 'Alım İrsaliye Girişi')->value('id');
		$satis_iade = $giris_islem_tipleri->where('islem_tipi', 'Satış İade İrsaliyesi')->value('id');
		$uretimden_giris = $giris_islem_tipleri->where('islem_tipi', 'Üretimden Giriş')->value('id');
		$konsinye_alim = $giris_islem_tipleri->where('islem_tipi', 'Konsinye Alım İrsaliyesi')->value('id');

        $cikis_islem_tipleri = Islem_tipleri::whereIn(
			'islem_tipi', ['Serbest Stok Çıkışı',
			'İrsaliyeli Çıkış',
			'Alım İade İrsaliyesi',
			'Üretime Çıkış',
			'Konsinye İade İrsaliyesi'
		])->get();

		$serbest_cikis = $cikis_islem_tipleri->where('islem_tipi', 'Serbest Stok Çıkışı')->value('id');
		$irsaliyeli_cikis = $cikis_islem_tipleri->where('islem_tipi', 'İrsaliyeli Çıkış')->value('id');
		$alim_iade = $cikis_islem_tipleri->where('islem_tipi', 'Alım İade İrsaliyesi')->value('id');
		$uretime_cikis = $cikis_islem_tipleri->where('islem_tipi', 'Üretime Çıkış')->value('id');
		$konsinye_iade = $cikis_islem_tipleri->where('islem_tipi', 'Konsinye İade İrsaliyesi')->value('id');

        $stok_girisler = Hareketler::whereIn(
			'islem_tipi_no', [$serbest_giris,$alim_irsaliye,$satis_iade,$uretimden_giris,$konsinye_alim])->where('sira_no', 1)->get()->count();

		$stok_cikislar = Hareketler::whereIn(
			'islem_tipi_no', [$serbest_cikis,$irsaliyeli_cikis,$alim_iade,$uretime_cikis,$konsinye_iade])->where('sira_no', 1)->get()->count();

        return view('sayfalar/genel', compact('stoklar', 'firmalar', 'stok_girisler', 'stok_cikislar'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Hareketler;
use App\Models\Islem_tipleri;
use App\Models\Depolar;
use App\Models\Firmalar;
use App\Models\Stoklar;
use App\Models\Birimler;
use Illuminate\Http\Request;

class stok_girisi extends Controller
{
	public function index()
	{
		$islem_tipleri = Islem_tipleri::whereIn(
			'islem_tipi', ['Serbest Stok Girişi',
			'Alım İrsaliye Girişi',
			'Satış İade İrsaliyesi',
			'Üretimden Giriş',
			'Konsinye Alım İrsaliyesi'
		])->get();
		$depolar = Depolar::all();
		$firmalar = Firmalar::all();
		$stoklar = Stoklar::all();
		$birimler = Birimler::all();
		$serbest_giris = $islem_tipleri->where('islem_tipi', 'Serbest Stok Girişi')->value('id');
		$alim_irsaliye = $islem_tipleri->where('islem_tipi', 'Alım İrsaliye Girişi')->value('id');
		$satis_iade = $islem_tipleri->where('islem_tipi', 'Satış İade İrsaliyesi')->value('id');
		$uretimden_giris = $islem_tipleri->where('islem_tipi', 'Üretimden Giriş')->value('id');
		$konsinye_alim = $islem_tipleri->where('islem_tipi', 'Konsinye Alım İrsaliyesi')->value('id');
		$stok_girisler = Hareketler::whereIn(
			'islem_tipi_no', [$serbest_giris,$alim_irsaliye,$satis_iade,$uretimden_giris,$konsinye_alim])->where('sira_no', 1)->get();
		$stok_girisler_tum = Hareketler::whereIn(
			'islem_tipi_no', [$serbest_giris,$alim_irsaliye,$satis_iade,$uretimden_giris,$konsinye_alim])->get();
		return view('sayfalar/stok-girisi', compact('stok_girisler', 'stok_girisler_tum', 'islem_tipleri', 'depolar', 'firmalar', 'stoklar', 'birimler'));
	}
	public function store(Request $request)
	{
		for ($i = 1; $i <= $request->get('sira_no'); $i++)
		{
			$stok_girisler = new Hareketler([
				'islem_tipi_no' => $request->get('islem_tipi_no'),
				'tarih' => $request->get('tarih'),
				'islem_no' => $request->get('islem_no'),
				'sira_no' => $request->get('sira_no-'.$i),
				'depo_no' => $request->get('depo_no'),
				'stok_no' => $request->get('stok_no-'.$i),
				'miktar' => $request->get('miktar-'.$i),
				'fiyat' => $request->get('fiyat-'.$i),
				'kdv_oran' => $request->get('kdv_oran-'.$i),
				'aciklama' => $request->get('aciklama'),
				'barkod_no' => $request->get('barkod_no-'.$i),
				'firma_no' => $request->get('firma_no'),
				'son_kullanim' => $request->get('son_kullanim-'.$i)
			]);
			$stok_girisler->save();
		}
		$islem_tipleri = Islem_tipleri::all();
		$deger = $islem_tipleri->where('id', $request->get('islem_tipi_no'))->value('deger');
		$islem_tipleri->where('id', $request->get('islem_tipi_no'))->first()->update(['deger' => $deger + 1]);
		return redirect('/stok-girisi')->with('success', 'Stok Girişi Oluşturuldu'); 
	}
	public function update(Request $request, $islem_no)
	{
		Hareketler::where('islem_no', $islem_no)->delete();
		for ($i = 1; $i <= $request->get('sira_no'); $i++)
		{
			$stok_girisler = new Hareketler([
				'islem_tipi_no' => $request->get('islem_tipi_no'),
				'tarih' => $request->get('tarih'),
				'islem_no' => $request->get('islem_no'),
				'sira_no' => $request->get('sira_no-'.$i),
				'depo_no' => $request->get('depo_no'),
				'stok_no' => $request->get('stok_no-'.$i),
				'miktar' => $request->get('miktar-'.$i),
				'fiyat' => $request->get('fiyat-'.$i),
				'kdv_oran' => $request->get('kdv_oran-'.$i),
				'aciklama' => $request->get('aciklama'),
				'barkod_no' => $request->get('barkod_no-'.$i),
				'firma_no' => $request->get('firma_no'),
				'son_kullanim' => $request->get('son_kullanim-'.$i)
			]);
			$stok_girisler->save();
		}
		return redirect('/stok-girisi')->with('success', 'Stok Girişi Güncellendi');
	}
	public function destroy($islem_no)
	{
		$stok_girisler = Hareketler::where('islem_no', $islem_no);
		$stok_girisler->delete();
		return redirect('/stok-girisi')->with('success', 'Stok Girişi Silindi');
	}
}
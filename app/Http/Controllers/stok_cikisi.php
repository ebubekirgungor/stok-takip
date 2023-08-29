<?php

namespace App\Http\Controllers;

use App\Models\Hareketler;
use App\Models\Islem_tipleri;
use App\Models\Depolar;
use App\Models\Firmalar;
use App\Models\Stoklar;
use App\Models\Birimler;
use Illuminate\Http\Request;

class stok_cikisi extends Controller
{
	public function index()
	{
		$islem_tipleri = Islem_tipleri::whereIn(
			'islem_tipi', ['Serbest Stok Çıkışı',
			'İrsaliyeli Çıkış',
			'Alım İade İrsaliyesi',
			'Üretime Çıkış',
			'Konsinye İade İrsaliyesi'
		])->get();
		$depolar = Depolar::all();
		$firmalar = Firmalar::all();
		$stoklar = Stoklar::all();
		$birimler = Birimler::all();
		$serbest_cikis = $islem_tipleri->where('islem_tipi', 'Serbest Stok Çıkışı')->value('id');
		$irsaliyeli_cikis = $islem_tipleri->where('islem_tipi', 'İrsaliyeli Çıkış')->value('id');
		$alim_iade = $islem_tipleri->where('islem_tipi', 'Alım İade İrsaliyesi')->value('id');
		$uretime_cikis = $islem_tipleri->where('islem_tipi', 'Üretime Çıkış')->value('id');
		$konsinye_iade = $islem_tipleri->where('islem_tipi', 'Konsinye İade İrsaliyesi')->value('id');
		$stok_cikislar = Hareketler::whereIn(
			'islem_tipi_no', [$serbest_cikis,$irsaliyeli_cikis,$alim_iade,$uretime_cikis,$konsinye_iade])->where('sira_no', 1)->get();
		$stok_cikislar_tum = Hareketler::whereIn(
			'islem_tipi_no', [$serbest_cikis,$irsaliyeli_cikis,$alim_iade,$uretime_cikis,$konsinye_iade])->get();
		return view('sayfalar/stok-cikisi', compact('stok_cikislar', 'stok_cikislar_tum', 'islem_tipleri', 'depolar', 'firmalar', 'stoklar', 'birimler'));
	}
	public function store(Request $request)
	{
		for ($i = 1; $i <= $request->get('sira_no'); $i++)
		{
			$stok_cikislar = new Hareketler([
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
			$stok_cikislar->save();
		}
		$islem_tipleri = Islem_tipleri::all();
		$deger = $islem_tipleri->where('id', $request->get('islem_tipi_no'))->value('deger');
		$islem_tipleri->where('id', $request->get('islem_tipi_no'))->first()->update(['deger' => $deger + 1]);
		return redirect('/stok-cikisi')->with('success', 'Stok Çıkışı Oluşturuldu'); 
	}
	public function update(Request $request, $islem_no)
	{
		Hareketler::where('islem_no', $islem_no)->delete();
		for ($i = 1; $i <= $request->get('sira_no'); $i++)
		{
			$stok_cikislar = new Hareketler([
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
			$stok_cikislar->save();
		}
		return redirect('/stok-cikisi')->with('success', 'Stok Çıkışı Güncellendi');
	}
	public function destroy($islem_no)
	{
		$stok_cikislar = Hareketler::where('islem_no', $islem_no);
		$stok_cikislar->delete();
		return redirect('/stok-cikisi')->with('success', 'Stok Çıkışı Silindi');
	}
}
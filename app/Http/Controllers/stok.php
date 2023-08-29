<?php

namespace App\Http\Controllers;

use App\Models\Stoklar;
use App\Models\Birimler;
use App\Models\Islem_tipleri;
use Illuminate\Http\Request;

class stok extends Controller
{
    public function index()
    {
        $stoklar = Stoklar::all();
        $birimler = Birimler::all();
				$islem_tipleri = Islem_tipleri::all();
				return view('sayfalar/stoklar', compact('stoklar', 'birimler', 'islem_tipleri'));
    }
    public function store(Request $request)
    {
        $stok = new Stoklar([
            'stok_kodu' => $request->get('stok_kodu'),
            'stok_adi' => $request->get('stok_adi'),
            'stok_adi2' => $request->get('stok_adi2'),
            'barkod' => $request->get('barkod'),
            'barkod2' => $request->get('barkod2'),
            'kdv_oran' => $request->get('kdv_oran'),
            'birim_fiyat' => $request->get('birim_fiyat'),
            'birim_no' => $request->get('birim_no'),
            'birim_no2' => $request->get('birim_no2'),
            'birim_katsayi' => $request->get('birim_katsayi'),
            'raf_no' => $request->get('raf_no'),
            'alt_raf_no' => $request->get('alt_raf_no'),
            'min_stok' => $request->get('min_stok'),
            'max_stok' => $request->get('max_stok')
        ]);
        $stok->save();
				$islem_tipleri = Islem_tipleri::all();
				$deger = $islem_tipleri->where('islem_tipi', 'Stok Tanımları')->value('deger');
				$islem_tipleri->where('islem_tipi', 'Stok Tanımları')->first()->update(['deger' => $deger + 1]);
        return redirect('/stoklar')->with('success', 'Stok Oluşturuldu'); 
    }
    public function update(Request $request, $id)
    {
        $stok = Stoklar::find($id);
        $stok->stok_kodu = $request->get('stok_kodu');
        $stok->stok_adi = $request->get('stok_adi');
        $stok->stok_adi2 = $request->get('stok_adi2');
        $stok->barkod = $request->get('barkod');
        $stok->barkod2 = $request->get('barkod2');
        $stok->kdv_oran = $request->get('kdv_oran');
        $stok->birim_fiyat = $request->get('birim_fiyat');
        $stok->birim_no = $request->get('birim_no');
        $stok->birim_no2 = $request->get('birim_no2');
        $stok->birim_katsayi = $request->get('birim_katsayi');
        $stok->raf_no = $request->get('raf_no');
        $stok->alt_raf_no = $request->get('alt_raf_no');
        $stok->min_stok = $request->get('min_stok');
        $stok->max_stok = $request->get('max_stok');
        $stok->save();
        return redirect('/stoklar')->with('success', 'Stok Güncellendi'); 
    }
    public function destroy($id)
    {
        $stok = Stoklar::find($id);
				$stok->delete();
				return redirect('/stoklar')->with('success', 'Stok Silindi');
    }
}

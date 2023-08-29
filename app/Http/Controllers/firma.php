<?php

namespace App\Http\Controllers;

use App\Models\Firmalar;
use App\Models\Islem_tipleri;
use Illuminate\Http\Request;

class firma extends Controller
{
    public function index()
    {
        $firmalar = Firmalar::all();
				$islem_tipleri = Islem_tipleri::all();
				return view('sayfalar/firmalar', compact('firmalar', 'islem_tipleri'));
    }
    public function store(Request $request)
    {
        $firma = new Firmalar([
            'firma_kodu' => $request->get('firma_kodu'),
            'firma_adi' => $request->get('firma_adi'),
            'adres' => $request->get('adres'),
            'adres2' => $request->get('adres2'),
            'tel' => $request->get('tel'),
            'tel2' => $request->get('tel2'),
            'fax' => $request->get('fax'),
            'vergi_dairesi' => $request->get('vergi_dairesi'),
            'vergi_no' => $request->get('vergi_no'),
            'yetkili' => $request->get('yetkili'),
            'aciklama' => $request->get('aciklama')
        ]);
        $firma->save();
				$islem_tipleri = Islem_tipleri::all();
				$deger = $islem_tipleri->where('islem_tipi', 'Firma Tanımları')->value('deger');
				$islem_tipleri->where('islem_tipi', 'Firma Tanımları')->first()->update(['deger' => $deger + 1]);
        return redirect('/firmalar')->with('success', 'Firma Oluşturuldu'); 
    }
    public function update(Request $request, $id)
    {
        $firma = Firmalar::find($id);
        $firma->firma_kodu = $request->get('firma_kodu');
        $firma->firma_adi = $request->get('firma_adi');
        $firma->adres = $request->get('adres');
        $firma->adres2 = $request->get('adres2');
        $firma->tel = $request->get('tel');
        $firma->tel2 = $request->get('tel2');
        $firma->fax = $request->get('fax');
        $firma->vergi_dairesi = $request->get('vergi_dairesi');
        $firma->vergi_no = $request->get('vergi_no');
        $firma->yetkili = $request->get('yetkili');
        $firma->aciklama = $request->get('aciklama');
        $firma->save();
        return redirect('/firmalar')->with('success', 'Firma Güncellendi'); 
    }
    public function destroy($id)
    {
        $firma = Firmalar::find($id);
				$firma->delete();
				return redirect('/firmalar')->with('success', 'Firma Silindi');
    }
}

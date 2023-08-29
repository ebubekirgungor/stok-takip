<?php

namespace App\Http\Controllers;

use App\Models\Depolar;
use Illuminate\Http\Request;

class depo extends Controller
{
    public function store(Request $request)
    {
        $depo = new Depolar([
            'depo_kodu' => $request->get('depo_kodu'),
            'depo_adi' => $request->get('depo_adi'),
            'depo_sorumlu' => $request->get('depo_sorumlu'),
            'depo_tel_no' => $request->get('depo_tel_no')
        ]);
        $depo->save();
        return redirect('/ayarlar')->with('success', 'Depo Oluşturuldu'); 
    }
    public function update(Request $request, $id)
    {
        $depo = Depolar::find($id);
        $depo->depo_kodu = $request->get('depo_kodu');
        $depo->depo_adi = $request->get('depo_adi');
        $depo->depo_sorumlu = $request->get('depo_sorumlu');
        $depo->depo_tel_no = $request->get('depo_tel_no');
        $depo->save();
        return redirect('/ayarlar')->with('success', 'Depo Güncellendi'); 
    }
    public function destroy($id)
    {
        $depo = Depolar::find($id);
				$depo->delete();
				return redirect('/ayarlar')->with('success', 'Depo Silindi');
    }
}

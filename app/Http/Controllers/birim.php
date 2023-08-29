<?php

namespace App\Http\Controllers;

use App\Models\Birimler;
use Illuminate\Http\Request;

class birim extends Controller
{
    public function store(Request $request)
    {
        $birim = new Birimler([
            'birim' => $request->get('birim')
        ]);
        $birim->save();
        return redirect('/ayarlar')->with('success', 'Birim Oluşturuldu'); 
    }
    public function update(Request $request, $id)
    {
        $birim = Birimler::find($id);
        $birim->birim = $request->get('birim');
        $birim->save();
        return redirect('/ayarlar')->with('success', 'Birim Güncellendi'); 
    }
    public function destroy($id)
    {
        $birim = Birimler::find($id);
				$birim->delete();
				return redirect('/ayarlar')->with('success', 'Birim Silindi');
    }
}

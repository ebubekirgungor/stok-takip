<?php

namespace App\Http\Controllers;

use App\Models\Islem_tipleri;
use Illuminate\Http\Request;

class islem_tipi extends Controller
{
    public function store(Request $request)
    {
        $islem_tipi = new Islem_tipleri([
						'islem_tipi' => $request->get('islem_tipi'),
            'on_ek' => $request->get('on_ek'),
            'deger' => $request->get('deger')
        ]);
        $islem_tipi->save();
        return redirect('/ayarlar')->with('success', 'İşlem Tipi Oluşturuldu'); 
    }
    public function update(Request $request, $id)
    {
        $islem_tipi = Islem_tipleri::find($id);
        $islem_tipi->islem_tipi = $request->get('islem_tipi');
        $islem_tipi->on_ek = $request->get('on_ek');
        $islem_tipi->deger = $request->get('deger');
        $islem_tipi->save();
        return redirect('/ayarlar')->with('success', 'İşlem Tipi Güncellendi'); 
    }
    public function destroy($id)
    {
        $islem_tipi = Islem_tipleri::find($id);
				$islem_tipi->delete();
				return redirect('/ayarlar')->with('success', 'İşlem Tipi Silindi');
    }
}

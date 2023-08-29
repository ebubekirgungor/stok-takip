@extends('layouts.app')
@section('icerik')
<div class="box">
<div class="table-baslik" style="cursor: default;">Stoklar <button class="button tooltip" style="margin-top: -5px;" onclick="document.getElementById('add').style.visibility = 'visible'; document.getElementById('add').style.opacity = '1';"><i class="fal fa-plus"></i><span class="tooltiptext">Stok Ekle</span></button></div>
<table id="stokTable">
	<thead>
		<tr>
			<th>Stok Kodu</th>
			<th>Stok Adı</th>
			<th>Barkod</th>
			<th>Kdv Oranı</th>
			<th>Birim Fiyat</th>
			<th>Birim</th>
			<th>Raf No</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($stoklar as $stok)
		<tr class="td">
			<td>{{$stok->stok_kodu}}</td>
			<td>{{$stok->stok_adi}}</td>
			<td>{{$stok->barkod}}</td>
			<td>{{$stok->kdv_oran}}</td>
			<td>{{$stok->birim_fiyat}}</td>
			<td>{{$birimler->where('id', $stok->birim_no)->value('birim');}}</td>
			<td>{{$stok->raf_no}}</td>
			<td class="tdbutton"><button class="button tooltip" onclick="document.getElementById('edit-{{$stok->id}}').style.visibility = 'visible'; document.getElementById('edit-{{$stok->id}}').style.opacity = '1';"><i class="fal fa-edit"></i><span class="tooltiptext">Düzenle</span></button><form action="{{ route('stoklar.destroy', $stok->id)}}" method="post">@csrf @method('DELETE')<button class="button tooltip" type="submit"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></form></td>
		</tr>
		@endforeach
	</tbody>
</table>
		</div>
@foreach($stoklar as $stok)
<div class="editbox" id='edit-{{$stok->id}}'>
	<h1 class="editbaslik">Düzenle</h1><i class="fal fa-times kapat" onclick="document.getElementById('edit-{{$stok->id}}').style.opacity = '0'; document.getElementById('edit-{{$stok->id}}').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('stoklar.update', $stok->id) }}">
	@method('PATCH')
  @csrf
		<input type="hidden" name="stok_kodu" value="{{$stok->stok_kodu}}"></input>
		<label class="editlabel">Stok Kodu: <input disabled class="editinput" type="text" value="{{$stok->stok_kodu}}"></input></label>
		<label class="editlabel">Stok Adı: <input required class="editinput" type="text" name="stok_adi" value="{{$stok->stok_adi}}"></input></label>
		<label class="editlabel">Stok Adı 2: <input class="editinput" type="text" name="stok_adi2" value="{{$stok->stok_adi2}}"></input></label>
		<label class="editlabel">Barkod: <input class="editinput" type="text" name="barkod" value="{{$stok->barkod}}"></input></label>
		<label class="editlabel">Barkod 2: <input class="editinput" type="text" name="barkod2" value="{{$stok->barkod2}}"></input></label>
		<label class="editlabel">Kdv Oranı: <input required class="editinput" type="text" name="kdv_oran" value="{{$stok->kdv_oran}}"></input></label>
		<label class="editlabel">Birim Fiyat: <input required class="editinput" type="text" name="birim_fiyat" value="{{$stok->birim_fiyat}}"></input></label>
		<label class="editlabel">Birim: <select required class="editinput" name="birim_no">
			<option value=""></option>
			@foreach($birimler as $birim)
			<option @if ($birim->id == $birimler->where('id', $stok->birim_no)->value('id')) selected @endif  value="{{$birim->id}}">{{$birim->birim}}</option>
			@endforeach
		</select>
		</label>
		<label class="editlabel">Birim 2: <select class="editinput" style="margin-right: 175px; width: 78px;" name="birim_no2">
			<option value=""></option>
			@foreach($birimler as $birim)
			<option @if ($birim->id == $birimler->where('id', $stok->birim_no2)->value('id')) selected @endif  value="{{$birim->id}}">{{$birim->birim}}</option>
			@endforeach
		</select><span style="float: right; margin-right: -92px;">X</span><input class="editinput" style="text-align: right; margin-left: 15px; margin-top: -19px; width: 78px;" type="text" name="birim_katsayi" value="{{$stok->birim_katsayi}}"></input>
		</label>
		<label class="editlabel">Raf No: <input class="editinput" type="text" name="raf_no" value="{{$stok->raf_no}}"></input></label>
		<label class="editlabel">Alt Raf No: <input class="editinput" type="text" name="alt_raf_no" value="{{$stok->alt_raf_no}}"></input></label>
		<label class="editlabel">Minimum Stok: <input class="editinput" type="text" name="min_stok" value="{{$stok->min_stok}}"></input></label>
		<label class="editlabel">Maximum Stok: <input class="editinput" type="text" name="max_stok" value="{{$stok->max_stok}}"></input></label>
		<input class="editbutton" type="submit" value="Kaydet"></input>
	</form>
</div>
@endforeach
<div class="editbox" id='add'>
	<h1 class="editbaslik">Stok Ekle</h1><i class="fal fa-times kapat" onclick="document.getElementById('add').style.opacity = '0'; document.getElementById('add').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('stoklar.store') }}">
  @csrf
		<input type="hidden" name="stok_kodu" value="{{$islem_tipleri->where('islem_tipi', 'Stok Tanımları')->value('on_ek');}}-{{$islem_tipleri->where('islem_tipi', 'Stok Tanımları')->value('deger');}}"></input>
		<label class="editlabel">Stok Kodu: <input disabled class="editinput" type="text" value="{{$islem_tipleri->where('islem_tipi', 'Stok Tanımları')->value('on_ek');}}-{{$islem_tipleri->where('islem_tipi', 'Stok Tanımları')->value('deger');}}"></input></label>
		<label class="editlabel">Stok Adı: <input required class="editinput" type="text" name="stok_adi"></input></label>
		<label class="editlabel">Stok Adı 2: <input class="editinput" type="text" name="stok_adi2"></input></label>
		<label class="editlabel">Barkod: <input class="editinput" type="text" name="barkod"></input></label>
		<label class="editlabel">Barkod 2: <input class="editinput" type="text" name="barkod2"></input></label>
		<label class="editlabel">Kdv Oranı: <input required class="editinput" type="text" name="kdv_oran"></input></label>
		<label class="editlabel">Birim Fiyat: <input required class="editinput" type="text" name="birim_fiyat"></input></label>
		<label class="editlabel">Birim: <select required class="editinput" name="birim_no">
			<option value=""></option>
			@foreach($birimler as $birim)
			<option value="{{$birim->id}}">{{$birim->birim}}</option>
			@endforeach
		</select>
		</label>
		<label class="editlabel">Birim 2: <select class="editinput" style="margin-right: 175px; width: 78px;" name="birim_no2">
		  <option value=""></option>
			@foreach($birimler as $birim)
			<option value="{{$birim->id}}">{{$birim->birim}}</option>
			@endforeach
		</select><span style="float: right; margin-right: -92px;">X</span><input class="editinput" style="text-align: right; margin-left: 15px; margin-top: -19px; width: 78px;" type="text" name="birim_katsayi"></input>
		</label>
		<label class="editlabel">Raf No: <input class="editinput" type="text" name="raf_no"></input></label>
		<label class="editlabel">Alt Raf No: <input class="editinput" type="text" name="alt_raf_no"></input></label>
		<label class="editlabel">Minimum Stok: <input class="editinput" type="text" name="min_stok"></input></label>
		<label class="editlabel">Maximum Stok: <input class="editinput" type="text" name="max_stok"></input></label>
		<input class="editbutton" type="submit" value="Ekle"></input>
	</form>
</div>
<script>
$(document).ready(function () {
    $('#stokTable').DataTable();
});
</script>
@stop

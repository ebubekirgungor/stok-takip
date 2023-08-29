@extends('layouts.app')
@section('icerik')
<div class="box">
<div class="table-baslik" style="cursor: default;">Firmalar <button class="button tooltip" style="margin-top: -5px;" onclick="document.getElementById('add').style.visibility = 'visible'; document.getElementById('add').style.opacity = '1';"><i class="fal fa-plus"></i><span class="tooltiptext">Firma Ekle</span></button></div>
<table id="firmaTable">
	<thead>
		<tr>
			<th>Firma Kodu</th>
			<th>Firma Adı</th>
			<th>Adres</th>
			<th>Telefon No</th>
			<th>Fax</th>
			<th>Vergi Dairesi</th>
			<th>Vergi No</th>
			<th>Yetkili</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($firmalar as $firma)
		<tr class="td">
			<td>{{$firma->firma_kodu}}</td>
			<td>{{$firma->firma_adi}}</td>
			<td>{{$firma->adres}}</td>
			<td>{{$firma->tel}}</td>
			<td>{{$firma->fax}}</td>
			<td>{{$firma->vergi_dairesi}}</td>
			<td>{{$firma->vergi_no}}</td>
			<td>{{$firma->yetkili}}</td>
			<td class="tdbutton"><button class="button tooltip" onclick="document.getElementById('edit-{{$firma->id}}').style.visibility = 'visible'; document.getElementById('edit-{{$firma->id}}').style.opacity = '1';"><i class="fal fa-edit"></i><span class="tooltiptext">Düzenle</span></button><form action="{{ route('firmalar.destroy', $firma->id)}}" method="post">@csrf @method('DELETE')<button class="button tooltip" type="submit"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></form></td>
		</tr>
		@endforeach
	</tbody>
</table>
		</div>
@foreach($firmalar as $firma)
<div class="editbox" id='edit-{{$firma->id}}'>
	<h1 class="editbaslik">Düzenle</h1><i class="fal fa-times kapat" onclick="document.getElementById('edit-{{$firma->id}}').style.opacity = '0'; document.getElementById('edit-{{$firma->id}}').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('firmalar.update', $firma->id) }}">
	@method('PATCH')
  @csrf
		<input type="hidden" name="firma_kodu" value="{{$firma->firma_kodu}}"></input>
		<label class="editlabel">Firma Kodu: <input disabled class="editinput" type="text" value="{{$firma->firma_kodu}}"></input></label>
		<label class="editlabel">Firma Adı: <input required class="editinput" type="text" name="firma_adi" value="{{$firma->firma_adi}}"></input></label>
		<label class="editlabel">Adres: <input class="editinput" type="text" name="adres" value="{{$firma->adres}}"></input></label>
		<label class="editlabel">Adres 2: <input class="editinput" type="text" name="adres2" value="{{$firma->adres2}}"></input></label>
		<label class="editlabel">Telefon No: <input required class="editinput" type="text" name="tel" value="{{$firma->tel}}"></input></label>
		<label class="editlabel">Telefon No 2: <input class="editinput" type="text" name="tel2" value="{{$firma->tel2}}"></input></label>
		<label class="editlabel">Fax: <input class="editinput" type="text" name="fax" value="{{$firma->fax}}"></input></label>
		<label class="editlabel">Vergi Dairesi: <input class="editinput" type="text" name="vergi_dairesi" value="{{$firma->vergi_dairesi}}"></input></label>
		<label class="editlabel">Vergi No: <input class="editinput" type="text" name="vergi_no" value="{{$firma->vergi_no}}"></input></label>
		<label class="editlabel">Yetkili: <input class="editinput" type="text" name="yetkili" value="{{$firma->yetkili}}"></input></label>
		<label class="editlabel">Açıklama: <input class="editinput" type="text" name="aciklama" value="{{$firma->aciklama}}"></input></label>
		<input class="editbutton" type="submit" value="Kaydet"></input>
	</form>
</div>
@endforeach
<div class="editbox" id='add'>
	<h1 class="editbaslik">Firma Ekle</h1><i class="fal fa-times kapat" onclick="document.getElementById('add').style.opacity = '0'; document.getElementById('add').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('firmalar.store') }}">
  @csrf
		<input type="hidden" name="firma_kodu" value="{{$islem_tipleri->where('islem_tipi', 'Firma Tanımları')->value('on_ek');}}-{{$islem_tipleri->where('islem_tipi', 'Firma Tanımları')->value('deger');}}"></input>
		<label class="editlabel">Firma Kodu: <input disabled class="editinput" type="text" value="{{$islem_tipleri->where('islem_tipi', 'Firma Tanımları')->value('on_ek');}}-{{$islem_tipleri->where('islem_tipi', 'Firma Tanımları')->value('deger');}}"></input></label>
		<label class="editlabel">Firma Adı: <input required class="editinput" type="text" name="firma_adi"></input></label>
		<label class="editlabel">Adres: <input class="editinput" type="text" name="adres"></input></label>
		<label class="editlabel">Adres 2: <input class="editinput" type="text" name="adres2"></input></label>
		<label class="editlabel">Telefon No: <input required class="editinput" type="text" name="tel"></input></label>
		<label class="editlabel">Telefon No 2: <input class="editinput" type="text" name="tel2"></input></label>
		<label class="editlabel">Fax: <input class="editinput" type="text" name="fax"></input></label>
		<label class="editlabel">Vergi Dairesi: <input class="editinput" type="text" name="vergi_dairesi"></input></label>
		<label class="editlabel">Vergi No: <input class="editinput" type="text" name="vergi_no"></input></label>
		<label class="editlabel">Yetkili: <input class="editinput" type="text" name="yetkili"></input></label>
		<label class="editlabel">Açıklama: <input class="editinput" type="text" name="aciklama"></input></label>
		<input class="editbutton" type="submit" value="Ekle"></input>
	</form>
</div>
<script>
$(document).ready(function () {
    $('#firmaTable').DataTable({order: [[0, 'desc']]});
});
</script>
@stop

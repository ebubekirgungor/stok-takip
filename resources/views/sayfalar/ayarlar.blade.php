@extends('layouts.app')
@section('icerik')
<div class="tablebox" id="depo">
<div class="table-baslik" onclick="tableac('depo')">Depolar <button class="button tooltip" style="margin-top: -5px;" onclick="stopFunc(event); document.getElementById('add-depo').style.visibility = 'visible'; document.getElementById('add-depo').style.opacity = '1';"><i class="fal fa-plus"></i><span class="tooltiptext">Depo Ekle</span></button></div>
<table id="depoTable">
	<thead>
		<tr>
			<th>Depo Kodu</th>
			<th>Depo Adı</th>
			<th>Depo Sorumlusu</th>
			<th>Telefon No</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($depolar as $depo)
		<tr class="td">
			<td>{{$depo->depo_kodu}}</td>
			<td>{{$depo->depo_adi}}</td>
			<td>{{$depo->depo_sorumlu}}</td>
			<td>{{$depo->depo_tel_no}}</td>
			<td class="tdbutton"><button class="button tooltip" onclick="document.getElementById('edit-depo{{$depo->id}}').style.visibility = 'visible'; document.getElementById('edit-depo{{$depo->id}}').style.opacity = '1';"><i class="fal fa-edit"></i><span class="tooltiptext">Düzenle</span></button><form action="{{ route('depolar.destroy', $depo->id)}}" method="post">@csrf @method('DELETE')<button class="button tooltip" type="submit"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></form></td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>

<div class="tablebox" style="margin-top: 15px;" id="islem">
<div class="table-baslik" onclick="tableac('islem')">İşlem Tipleri <button class="button tooltip" style="margin-top: -5px;" onclick="stopFunc(event); document.getElementById('add-islem_tipi').style.visibility = 'visible'; document.getElementById('add-islem_tipi').style.opacity = '1';"><i class="fal fa-plus"></i><span class="tooltiptext">İşlem Tipi Ekle</span></button></div>
<table id="islemTable">
	<thead>
		<tr>
			<th>İşlem Tipi</th>
			<th>Ön Ek </th>
			<th>Sıra No</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($islem_tipleri as $islem_tipi)
		<tr class="td">
			<td>{{$islem_tipi->islem_tipi}}</td>
			<td>{{$islem_tipi->on_ek}}</td>
			<td>{{$islem_tipi->deger}}</td>
			<td class="tdbutton"><button class="button tooltip" onclick="document.getElementById('edit-islem_tipi{{$islem_tipi->id}}').style.visibility = 'visible'; document.getElementById('edit-islem_tipi{{$islem_tipi->id}}').style.opacity = '1';"><i class="fal fa-edit"></i><span class="tooltiptext">Düzenle</span></button><form action="{{ route('islem_tipleri.destroy', $islem_tipi->id)}}" method="post">@csrf @method('DELETE')<button class="button tooltip" type="submit"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></form></td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>

<div class="tablebox" style="margin-top: 15px;" id="birim">
<div class="table-baslik" onclick="tableac('birim')">Birimler <button class="button tooltip" style="margin-top: -5px;" onclick="stopFunc(event); document.getElementById('add-birim').style.visibility = 'visible'; document.getElementById('add-birim').style.opacity = '1';"><i class="fal fa-plus"></i><span class="tooltiptext">Birim Ekle</span></button></div>
<table id="birimTable">
	<thead>
		<tr>
			<th>Birim Adı</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($birimler as $birim)
		<tr class="td">
			<td>{{$birim->birim}}</td>
			<td class="tdbutton"><button class="button tooltip" onclick="document.getElementById('edit-birim{{$birim->id}}').style.visibility = 'visible'; document.getElementById('edit-birim{{$birim->id}}').style.opacity = '1';"><i class="fal fa-edit"></i><span class="tooltiptext">Düzenle</span></button><form action="{{ route('birimler.destroy', $birim->id)}}" method="post">@csrf @method('DELETE')<button class="button tooltip" type="submit"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></form></td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
@foreach($depolar as $depo)
<div class="editbox" id='edit-depo{{$depo->id}}'>
	<h1 class="editbaslik">Düzenle</h1><i class="fal fa-times kapat" onclick="document.getElementById('edit-depo{{$depo->id}}').style.opacity = '0'; document.getElementById('edit-depo{{$depo->id}}').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('depolar.update', $depo->id) }}">
	@method('PATCH')
  @csrf
		<label class="editlabel">Depo Kodu: <input class="editinput" type="text" name="depo_kodu" value="{{$depo->depo_kodu}}"></input></label>
		<label class="editlabel">Depo Adı: <input required class="editinput" type="text" name="depo_adi" value="{{$depo->depo_adi}}"></input></label>
		<label class="editlabel">Depo Sorumlusu: <input class="editinput" type="text" name="depo_sorumlu" value="{{$depo->depo_sorumlu}}"></input></label>
		<label class="editlabel">Telefon No: <input class="editinput" type="text" name="depo_tel_no" value="{{$depo->depo_tel_no}}"></input></label>
		<input class="editbutton" type="submit" value="Kaydet"></input>
	</form>
</div>
@endforeach
<div class="editbox" id='add-depo'>
	<h1 class="editbaslik">Depo Ekle</h1><i class="fal fa-times kapat" onclick="document.getElementById('add-depo').style.opacity = '0'; document.getElementById('add-depo').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('depolar.store') }}">
  @csrf
		<label class="editlabel">Depo Kodu: <input class="editinput" type="text" name="depo_kodu"></input></label>
		<label class="editlabel">Depo Adı: <input required class="editinput" type="text" name="depo_adi"></input></label>
		<label class="editlabel">Depo Sorumlusu: <input class="editinput" type="text" name="depo_sorumlu"></input></label>
		<label class="editlabel">Telefon No: <input class="editinput" type="text" name="depo_tel_no"></input></label>
		<input class="editbutton" type="submit" value="Ekle"></input>
	</form>
</div>

@foreach($islem_tipleri as $islem_tipi)
<div class="editbox" id='edit-islem_tipi{{$islem_tipi->id}}'>
	<h1 class="editbaslik">Düzenle</h1><i class="fal fa-times kapat" onclick="document.getElementById('edit-islem_tipi{{$islem_tipi->id}}').style.opacity = '0'; document.getElementById('edit-islem_tipi{{$islem_tipi->id}}').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('islem_tipleri.update', $islem_tipi->id) }}">
	@method('PATCH')
  @csrf
		<label class="editlabel">İşlem Tipi: <input required class="editinput" type="text" name="islem_tipi" value="{{$islem_tipi->islem_tipi}}"></input></label>
		<label class="editlabel">Ön Ek: <input required class="editinput" type="text" name="on_ek" value="{{$islem_tipi->on_ek}}"></input></label>
		<input type="hidden" name="deger" value="{{$islem_tipi->deger}}"></input>
		<input class="editbutton" type="submit" value="Kaydet"></input>
	</form>
</div>
@endforeach
<div class="editbox" id='add-islem_tipi'>
	<h1 class="editbaslik">İşlem Tipi Ekle</h1><i class="fal fa-times kapat" onclick="document.getElementById('add-islem_tipi').style.opacity = '0'; document.getElementById('add-islem_tipi').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('islem_tipleri.store') }}">
  @csrf
		<label class="editlabel">İşlem Tipi: <input required class="editinput" type="text" name="islem_tipi"></input></label>
		<label class="editlabel">Ön Ek: <input required class="editinput" type="text" name="on_ek"></input></label>
		<input type="hidden" name="deger" value=1></input>
		<input class="editbutton" type="submit" value="Ekle"></input>
	</form>
</div>

@foreach($birimler as $birim)
<div class="editbox" id='edit-birim{{$birim->id}}'>
	<h1 class="editbaslik">Düzenle</h1><i class="fal fa-times kapat" onclick="document.getElementById('edit-birim{{$birim->id}}').style.opacity = '0'; document.getElementById('edit-birim{{$birim->id}}').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('birimler.update', $birim->id) }}">
	@method('PATCH')
  @csrf
		<label class="editlabel">Birim Adı: <input required class="editinput" type="text" name="birim" value="{{$birim->birim}}"></input></label>
		<input class="editbutton" type="submit" value="Kaydet"></input>
	</form>
</div>
@endforeach
<div class="editbox" id='add-birim'>
	<h1 class="editbaslik">Birim Ekle</h1><i class="fal fa-times kapat" onclick="document.getElementById('add-birim').style.opacity = '0'; document.getElementById('add-birim').style.visibility = 'hidden';"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('birimler.store') }}">
  @csrf
		<label class="editlabel">Birim Adı: <input required class="editinput" type="text" name="birim"></input></label>
		<input class="editbutton" type="submit" value="Ekle"></input>
	</form>
</div>
<script>
function tableac(t)
{
	document.getElementById(t).classList.toggle("acik");
	var tbl = document.getElementsByClassName("tablebox");
	for (var i = 0; i < tbl.length; i++)
	{
		if (tbl[i].id != t)
		{
			tbl[i].classList.remove("acik");
		}
	}
}
function stopFunc(e)
{
    e.stopPropagation();
}
$(document).ready(function () {
    $('#depoTable').DataTable({searching: false, lengthChange: false});
	$('#islemTable').DataTable({order: [[2, 'desc']], searching: false, lengthChange: false});
	$('#birimTable').DataTable({searching: false, lengthChange: false});
});
</script>
@stop

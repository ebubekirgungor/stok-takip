@extends('layouts.app')
@section('icerik')
<div class="box">
<div class="table-baslik" style="cursor: default;">Stok Girişleri <button class="button tooltip" style="margin-top: -5px;" onclick="tarih(); ac('add');"><i class="fal fa-plus"></i><span class="tooltiptext">Giriş Ekle</span></button></div>
<table id="girisTable">
	<thead>
		<tr>
			<th>İşlem No</th>
			<th>Depo</th>
			<th>Giriş Tipi</th>
			<th>Tarih</th>
			<th>Firma</th>
			<th>Açıklama</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($stok_girisler as $giris)
		<tr class="td">
			<td>{{$giris->islem_no}}</td>
			<td>{{$depolar->where('id', $giris->depo_no)->value('depo_adi');}}</td>
			<td>{{$islem_tipleri->where('id', $giris->islem_tipi_no)->value('islem_tipi');}}</td>
			<td>{{$giris->tarih}}</td>
			<td>{{$firmalar->where('id', $giris->firma_no)->value('firma_adi');}}</td>
			<td>{{$giris->aciklama}}</td>
			<td class="tdbutton"><button class="button tooltip" onclick="ac('edit-{{$giris->id}}')"><i class="fal fa-edit"></i><span class="tooltiptext">Düzenle</span></button><form action="{{ route('stok-girisi.destroy', $giris->islem_no)}}" method="post">@csrf @method('DELETE')<button class="button tooltip" type="submit"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></form></td>
		</tr>
		@endforeach
	</tbody>
</table>
		</div>
@foreach($stok_girisler as $giris)
<div class="editbox" id='edit-{{$giris->id}}'>
	<h1 class="editbaslik">Düzenle</h1><i class="fal fa-times kapat" onclick="kapa('edit-{{$giris->id}}')"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('stok-girisi.update', $giris->islem_no) }}">
	@method('PATCH')
  @csrf
		<input id="islemno_hidden-{{$giris->id}}" type="hidden" name="islem_no" value="{{$giris->islem_no}}"></input>
		<label class="editlabel">İşlem No: <input id="islemno-{{$giris->id}}" disabled class="editinput" type="text" value="{{$giris->islem_no}}"></input></label>
		<label class="editlabel">Depo: <select required class="editinput" name="depo_no">
			<option value=""></option>
			@foreach($depolar as $depo)
			<option @if ($depo->id == $depolar->where('id', $giris->depo_no)->value('id')) selected @endif value="{{$depo->id}}">{{$depo->depo_adi}}</option>
			@endforeach
		</select>
		</label>
		<label class="editlabel">Giriş Tipi: <select required class="editinput" onchange="selectGiris(this, '-{{$giris->id}}')" name="islem_tipi_no">
			<option value=""></option>
			@foreach($islem_tipleri as $islem)
			<option @if ($islem->id == $islem_tipleri->where('id', $giris->islem_tipi_no)->value('id')) selected @endif onek="{{$islem->on_ek}}" deger="{{$islem->deger}}" value="{{$islem->id}}">{{$islem->islem_tipi}}</option>
			@endforeach
		</select>
		</label>
		<label class="editlabel">Tarih: <input required class="editinput" type="datetime-local" value="{{$giris->tarih}}" name="tarih"></input></label>
		<input type="hidden" id="firma_no-{{$giris->id}}" name="firma_no" value="{{$giris->firma_no}}"></input>
		<label class="editlabel">Firma: <input readonly id="firma_adi-{{$giris->id}}" value="{{$firmalar->where('id', $giris->firma_no)->value('firma_adi');}}" class="editinput" style="width: 150px;" type="text"></input><div class="karebutton" onclick="ac('firmaadd-{{$giris->id}}')"><i class="fal fa-plus"></i></div></label>
		<label class="editlabel">Açıklama: <input class="editinput" type="text" value="{{$giris->aciklama}}" name="aciklama"></input></label>
		<br />
		<table style="background-color: #ecf0ff; white-space:nowrap;">
			<thead>
				<tr>
					<th>Stok Kodu</th>
					<th>Barkod No</th>
					<th>Stok Adı</th>
					<th>Miktar</th>
					<th>Birim</th>
					<th>Fiyat</th>
					<th>KDV %</th>
					<th>Son Kullanım</th>
					<th>Sıra</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="stokadd_table-{{$giris->id}}">
				@foreach($stok_girisler_tum as $giris_tum)
					@if ($giris->islem_no == $giris_tum->islem_no)
						<tr class="td">
							<td>{{$stoklar->where('id', $giris_tum->stok_no)->value('stok_kodu');}}</td>
							<td>{{$giris_tum->barkod_no}}</td>
							<td>{{$stoklar->where('id', $giris_tum->stok_no)->value('stok_adi');}}</td>
							<td><input type='number' style="width: 45px;" name='miktar-{{$giris_tum->sira_no}}' value="{{$giris_tum->miktar}}"></td>
							<td>{{$birimler->where('id', $stoklar->where('id', $giris_tum->stok_no)->value('birim_no'))->value('birim')}}</td>
							<td>{{$giris_tum->fiyat}}</td>
							<td>{{$giris_tum->kdv_oran}}</td>
							<td><input id="sonkullanim-{{$giris_tum->id}}-{{$giris_tum->sira_no}}" value='{{$giris_tum->son_kullanim}}' style="width: 100px;" type='date' name='son_kullanim-{{$giris_tum->sira_no}}'></td>
							<td>{{$giris_tum->sira_no}}</td>
							<td><button onclick="stoksil(this, '-{{$giris->id}}')" class="button tooltip"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></td>
							<input type='hidden' name='stok_no-{{$giris_tum->sira_no}}' value='{{$giris_tum->stok_no}}'>
							<input type='hidden' name='barkod_no-{{$giris_tum->sira_no}}' value='{{$giris_tum->barkod_no}}'>
							<input type='hidden' name='fiyat-{{$giris_tum->sira_no}}' value='{{$giris_tum->fiyat}}'>
							<input type='hidden' name='kdv_oran-{{$giris_tum->sira_no}}' value='{{$giris_tum->kdv_oran}}'>
							<input type='hidden' name='sira_no-{{$giris_tum->sira_no}}' value='{{$giris_tum->sira_no}}'>
						</tr>
					@endif
				@endforeach
			</tbody>
			<tfoot>
				<tr style="cursor: pointer;" onclick="ac('stokadd-{{$giris->id}}')">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" id="sira_no-{{$giris->id}}" name="sira_no" value=""></input>
		<input id="kaydetbutton-{{$giris->id}}" class="editbutton" type="submit" value="Kaydet"></input>
	</form>
</div>

<div class="editbox" id='firmaadd-{{$giris->id}}'>
	<h1 class="editbaslik">Firma Seç</h1><i class="fal fa-times kapat" onclick="kapa('firmaadd-{{$giris->id}}')"></i>
	<br />
	<table>
		<thead>
			<tr>
				<th>Firma</th>
			</tr>
		</thead>
		<tbody>
			@foreach($firmalar as $firma)
			<tr class="td">
				<td style="cursor: pointer;" firmano="{{$firma->id}}" firmaadi="{{$firma->firma_adi}}" onclick="firmaSec(this, '-{{$giris->id}}')">{{$firma->firma_adi}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="editbox" id='stokadd-{{$giris->id}}'>
	<h1 class="editbaslik">Stok Seç</h1><i class="fal fa-times kapat" onclick="kapa('stokadd-{{$giris->id}}')"></i>
	<br />
	<table>
		<thead>
			<tr>
				<th>Stok Kodu</th>
				<th>Barkod</th>
			</tr>
		</thead>
		<tbody>
			@foreach($stoklar as $stok)
			<tr style="cursor: pointer;" id="{{$stok->id}}" onclick="stokSec(this, '-{{$giris->id}}')" class="td">
				<td id="{{$stok->stok_kodu}}">{{$stok->stok_kodu}}</td>
				<td id="{{$stok->barkod}}">{{$stok->barkod}}</td>
				<input id="{{$stok->stok_adi}}" type="hidden">
				<input id="{{$birimler->where('id', $stok->birim_no)->value('birim')}}" type="hidden">
				<input id="{{$stok->birim_fiyat}}" type="hidden">
				<input id="{{$stok->kdv_oran}}" type="hidden">
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endforeach
<div class="editbox" id='add'>
	<h1 class="editbaslik">Giriş Ekle</h1><i class="fal fa-times kapat" onclick="kapa('add')"></i>
	<br />
	<form autocomplete="off" method="post" action="{{ route('stok-girisi.store') }}">
  @csrf
		<input id="islemno_hidden" type="hidden" name="islem_no" value=""></input>
		<label class="editlabel">İşlem No: <input id="islemno" disabled class="editinput" type="text" value=""></input></label>
		<label class="editlabel">Depo: <select required class="editinput" name="depo_no">
			<option value=""></option>
			@foreach($depolar as $depo)
			<option value="{{$depo->id}}">{{$depo->depo_adi}}</option>
			@endforeach
		</select>
		</label>
		<label class="editlabel">Giriş Tipi: <select required class="editinput" onchange="selectGiris(this, '')" name="islem_tipi_no">
			<option value=""></option>
			@foreach($islem_tipleri as $islem)
			<option onek="{{$islem->on_ek}}" deger="{{$islem->deger}}" value="{{$islem->id}}">{{$islem->islem_tipi}}</option>
			@endforeach
		</select>
		</label>
		<label class="editlabel">Tarih: <input required class="editinput" id="addtarih" type="datetime-local" name="tarih"></input></label>
		<input type="hidden" id="firma_no" name="firma_no" value=""></input>
		<label class="editlabel">Firma: <input readonly id="firma_adi" class="editinput" style="width: 150px;" type="text"></input><div class="karebutton" onclick="ac('firmaadd')"><i class="fal fa-plus"></i></div></label>
		<label class="editlabel">Açıklama: <input class="editinput" type="text" name="aciklama"></input></label>
		<br />
		<table style="background-color: #ecf0ff; white-space:nowrap;">
			<thead>
				<tr>
					<th>Stok Kodu</th>
					<th>Barkod No</th>
					<th>Stok Adı</th>
					<th>Miktar</th>
					<th>Birim</th>
					<th>Fiyat</th>
					<th>KDV %</th>
					<th>Son Kullanım</th>
					<th>Sıra</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="stokadd_table">

			</tbody>
			<tfoot>
				<tr style="cursor: pointer;" onclick="ac('stokadd')">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" id="sira_no" name="sira_no" value=""></input>
		<input id="kaydetbutton" class="editbutton disabledbutton" type="submit" value="Ekle"></input>
	</form>
</div>
<div class="editbox" id='firmaadd'>
	<h1 class="editbaslik">Firma Seç</h1><i class="fal fa-times kapat" onclick="kapa('firmaadd')"></i>
	<br />
	<table class="centertable">
		<thead>
			<tr>
				<th>Firma</th>
			</tr>
		</thead>
		<tbody>
			@foreach($firmalar as $firma)
			<tr class="td">
				<td style="cursor: pointer;" firmano="{{$firma->id}}" firmaadi="{{$firma->firma_adi}}" onclick="firmaSec(this, '')">{{$firma->firma_adi}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="editbox" id='stokadd'>
	<h1 class="editbaslik">Stok Seç</h1><i class="fal fa-times kapat" onclick="kapa('stokadd')"></i>
	<br />
	<table class="centertable">
		<thead>
			<tr>
				<th>Stok Kodu</th>
				<th>Barkod</th>
			</tr>
		</thead>
		<tbody>
			@foreach($stoklar as $stok)
			<tr style="cursor: pointer;" id="{{$stok->id}}" onclick="stokSec(this, '')" class="td">
				<td id="{{$stok->stok_kodu}}">{{$stok->stok_kodu}}</td>
				<td id="{{$stok->barkod}}">{{$stok->barkod}}</td>
				<input id="{{$stok->stok_adi}}" type="hidden">
				<input id="{{$birimler->where('id', $stok->birim_no)->value('birim')}}" type="hidden">
				<input id="{{$stok->birim_fiyat}}" type="hidden">
				<input id="{{$stok->kdv_oran}}" type="hidden">
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script>
$(document).ready(function () {
    $('#girisTable').DataTable();
});

@foreach($stok_girisler as $giris)
	document.getElementById("sira_no-{{$giris->id}}").value = document.getElementById("stokadd_table-{{$giris->id}}").childElementCount;
@endforeach

document.getElementById("sira_no").value = document.getElementById("stokadd_table").childElementCount;

function ac(id) {
	document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.opacity = "1";
}
function kapa(id) {
	document.getElementById(id).style.opacity = "0";
	document.getElementById(id).style.visibility = "hidden";
}
function tarih() {
	var tarih = new Date();
	tarih.setMinutes(tarih.getMinutes() - tarih.getTimezoneOffset());
	document.getElementById("addtarih").value = tarih.toISOString().slice(0,16);
}
function firmaSec(f, id) {
	document.getElementById("firma_no"+id).value = f.getAttribute("firmano");
	document.getElementById("firma_adi"+id).value = f.getAttribute("firmaadi");
	document.getElementById("firmaadd"+id).style.opacity = "0";
	document.getElementById("firmaadd"+id).style.visibility = "hidden";
}
function stoksil(s, id) {
	s.parentElement.parentElement.remove();
	var stoksirasi = document.getElementById("stokadd_table"+id).childElementCount;
	document.getElementById("sira_no"+id).value = stoksirasi;
	for (var i = 0; i < document.getElementById("stokadd_table"+id).childElementCount; i++)
	{
		document.getElementById("stokadd_table"+id).children[i].children[8].innerHTML = i + 1;
		document.getElementById("stokadd_table"+id).children[i].children[14].value = i + 1;
		document.getElementById("stokadd_table"+id).children[i].children[3].firstChild.name = "miktar-" + (i + 1);
		document.getElementById("stokadd_table"+id).children[i].children[7].firstChild.name = "son_kullanim-" + (i + 1);
		document.getElementById("stokadd_table"+id).children[i].children[10].name = "stok_no-" + (i + 1);
		document.getElementById("stokadd_table"+id).children[i].children[11].name = "barkod_no-" + (i + 1);
		document.getElementById("stokadd_table"+id).children[i].children[12].name = "fiyat-" + (i + 1);
		document.getElementById("stokadd_table"+id).children[i].children[13].name = "kdv_oran-" + (i + 1);
		document.getElementById("stokadd_table"+id).children[i].children[14].name = "sira_no-" + (i + 1);
	}
    if (document.getElementById("stokadd_table"+id).children.length == 0)
    {
        document.getElementById("kaydetbutton"+id).classList.add("disabledbutton");
    }
}
function stokSec(s, id) {
	var stoksirasi = document.getElementById("stokadd_table"+id).childElementCount + 1;
	document.getElementById("sira_no"+id).value = stoksirasi;
	const tabletr = document.createElement("tr");
	tabletr.classList.add("td");
	tabletr.innerHTML = `
		<td>${s.children[0].id}</td>
		<td>${s.children[1].id}</td>
		<td>${s.children[2].id}</td>
		<td><input type='number' style="width: 45px;" name='miktar-${stoksirasi}' value="0"></td>
		<td>${s.children[3].id}</td>
		<td>${s.children[4].id}</td>
		<td>${s.children[5].id}</td>
		<td><input id="sonkullanim${id}-${stoksirasi}" value='' style="width: 100px;" type='date' name='son_kullanim-${stoksirasi}'></td>
		<td>${stoksirasi}</td>
		<td><button onclick="stoksil(this, '${id}')" class="button tooltip"><i class="fal fa-trash-alt"></i><span class="tooltiptext">Sil</span></button></td>
		<input type='hidden' name='stok_no-${stoksirasi}' value='${s.id}'>
		<input type='hidden' name='barkod_no-${stoksirasi}' value='${s.children[1].id}'>
		<input type='hidden' name='fiyat-${stoksirasi}' value='${s.children[4].id}'>
		<input type='hidden' name='kdv_oran-${stoksirasi}' value='${s.children[5].id}'>
		<input type='hidden' name='sira_no-${stoksirasi}' value='${stoksirasi}'>
	`;
	document.getElementById("stokadd_table"+id).appendChild(tabletr);
	document.getElementById('sonkullanim' + id + '-' + stoksirasi).valueAsDate = new Date();

	document.getElementById('stokadd'+id).style.opacity = '0';
	document.getElementById('stokadd'+id).style.visibility = 'hidden';
    document.getElementById('kaydetbutton'+id).classList.remove('disabledbutton');
}
function selectGiris(x, id) {
	var onek = x[x.selectedIndex].getAttribute("onek");
  var deger = x[x.selectedIndex].getAttribute("deger");
	if (onek && deger)
	{
		document.getElementById("islemno"+id).value = onek + "-" + deger;
		document.getElementById("islemno_hidden"+id).value = onek + "-" + deger;
	}
	else
	{
		document.getElementById("islemno"+id).value = "";
		document.getElementById("islemno_hidden"+id).value = "";
	}
}
</script>
@stop

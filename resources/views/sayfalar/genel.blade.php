@extends('layouts.app')
@section('icerik')
<div class="info" onclick="location.href='/stoklar'">
	<i class="infoicon fal fa-layer-group"></i>
	<h1>Stoklar</h1>
	<h2>{{$stoklar}}</h2>
</div>
<div class="info" onclick="location.href='/firmalar'">
	<i class="infoicon fal fa-building"></i>
	<h1>Firmalar</h1>
	<h2>{{$firmalar}}</h2>
</div>
<div class="info" onclick="location.href='/stok-girisi'">
	<i class="infoicon fal fa-layer-plus"></i>
	<h1>Stok Girişleri</h1>
	<h2>{{$stok_girisler}}</h2>
</div>
<div class="info" onclick="location.href='/stok-cikisi'">
	<i class="infoicon fal fa-layer-minus"></i>
	<h1>Stok Çıkışları</h1>
	<h2>{{$stok_cikislar}}</h2>
</div>
@stop
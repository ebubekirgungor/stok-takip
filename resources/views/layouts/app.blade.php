<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="app.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="jquery.dataTables.min.js"></script>
	<link rel="preload" as="font" href="webfonts/fa-light-300.woff2" type="font/woff2" crossorigin="anonymous">
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<title>Stok Takip Panel</title>
</head>
<body>
	<div class="header">
		<h1>Stok Takip Panel</h1>
	</div>
  @include('includes.sidebar')
	<div class="icerik" @if (Request::segment(1) == "genel" || Request::segment(1) == "analiz-raporlar") style="padding: 0;" @endif>
		@yield('icerik')
	</div>
</body>
<style>
	a[href="/{{ Request::segment(1) }}"] {
		color: #000 !important;
		background: #fff;
		pointer-events: none;
	}
</style>
</html>

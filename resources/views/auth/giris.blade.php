<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="app.css" rel="stylesheet">
	<title>Stok Takip Panel</title>
</head>
<body>
	<div class="giris">
		<form method="POST" action="{{ route('giris') }}">
			@csrf
			<h2 class="baslik">Stok Takip Giriş</h2>
			<label for="email">
				E-Posta
			<input id="email" type="email" name="email" :value="old('email')" required autofocus />
			</label>
			<label for="password">
				Şifre
			<input id="password" type="password" name="password" required autocomplete="current-password" />
			</label>
			
			<label for="remember_me">
			<input id="remember_me" type="checkbox" name="remember">
			<span>Beni Hatırla</span>
			</label>
			@if (Route::has('sifremi-unuttum'))
				<a href="{{ route('sifremi-unuttum') }}">
					Şifremi Unuttum
				</a>
			@endif
			<button type="submit">
				Giriş
			</button>
		</form>
	</div>
</body>
<style>
html,
body {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
body {
  display: flex;
  justify-content: center;
  align-items: center;
  background: url(back.jpg) center/cover fixed;
}
* {
  box-sizing: border-box;
}
*::before,
*::after {
  content: '';
}
.giris {
  display: block;
  position: relative;
  padding: 4em 8em;
  background-color: rgba(0,0,0,0.3);
	border-radius: 7px;
  overflow: hidden;
  font-family: 'Raleway', sans-serif;
  box-shadow: 0 0 25px rgba(0,0,0,0.1), 0 5px 10px -3px rgba(0,0,0,0.13);
}
.giris::before {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url(back.jpg) center/cover fixed;
  margin: -30px;
  filter: blur(12px);
  z-index: -1;
}
.giris>form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.giris>form>*:not(:last-child) {
  margin-bottom: 15px;
}
.giris>form>label {
  -moz-user-select: -moz-none;
	-khtml-user-select: none;
	-webkit-user-select: none;
	-o-user-select: none;
	-ms-user-select: none;
	user-select: none;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-weight: 700;
  letter-spacing: 0.1em;
  font-size: 0.9em;
  color: #f2f2f8;
}
.giris>form>label>input {
  position: relative;
  display: block;
  width: 400px;
  margin-top: 0.5em;
  outline: none;
  border: none;
  font-family: 'Raleway', sans-serif;
  text-align: center;
  color: #212121;
  padding: 0.4em 1em;
  background-color: rgba(255,255,255,0.6);
  font-size: 1.1em;
  border-radius: 4px;
}
.giris>form>label>input[type=password] {
  letter-spacing: 2px;
  font-weight: 900;
}
.giris>form>button {
  border: none;
  outline: none;
  margin-top: 1em;
  padding: 1em 3em;
  border-radius: 4px;
  font-family: 'Raleway', sans-serif;
  font-weight: 900;
  letter-spacing: 0.15em;
  background-color: transparent;
  border: 3px solid #f2f2f8;
  color: #f2f2f8;
  transform: translate3D(0, 0, 0);
  transition: color 0.3s, background-color 0.3s, transform 0.15s;
  cursor: pointer;
}
.giris>form>button:hover {
  color: #212121;
  background-color: #f2f2f8;
  outline: none;
}
.giris>form>button:focus {
  outline: none;
}
.giris>form>button:active {
  transform: translate3D(0, 2px, 0);
  outline: none;
}
</style>
</html>
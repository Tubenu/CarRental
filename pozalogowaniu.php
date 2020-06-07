<?php
include 'connect.php';
	session_start();
	if(!isset($_SESSION['logged']))
	{
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	Nameless Geometry by nodethirtythree + Templated.org
	http://templated.org/ | @templatedorg
	Released under the Creative Commons Attribution 3.0 License.
	
	Note from the author: These templates take quite a bit of time to conceive,
	design, and finally code. So please, support our efforts by respecting our
	license: keep our footer credit links intact so people can find out about us
	and what we do. It's the right thing to do, and we'll love you for it :)
	
-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>XD</title>
		<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="bg">
			<div id="outer">
				<div id="header">
					<div id="logo">
						<h1>
							<a href="#">Samochody24.pl</a>
						</h1>
					</div>
					<div id="nav">
						<ul>
						<?php
		
	
	echo "Witaj ".$_SESSION['login'].'! [<a href="wylogowanie.php">Wyloguj się!</a>]';
	

?>
							<li class="first active">
								<a href="index.php">Strona główna</a>
							</li>
							<li>
								<a href="indexlogowanie.php">Zaloguj się</a>
							</li>
							<li>
								<a href="rejestracja.php">Załóż konto</a>
							</li>
							<li>
								<a href="samochody.php">Samochody w ofercie</a>
							</li>
						
						</ul>
						<br class="clear" />
					</div>
				</div>
				<div id="main">
					
					<div id="sidebar2">
						<h3>
							Jak to działa ?
						</h3>
						<p>
							Wybierasz z listy swój wymarzony samochód. Wybierasz na ile dni chciałbyś go mieć. Tworzysz zamówienie :D My zajmujemy się resztą:
							Dowóz na adres przez naszych wyspecjalizowanych kierowcow oraz wszelkie świadczenia potrzebne do jazdy.
						</p>
					
						<h3>
							Dlaczego my?
						</h3>
						<img class="top" src="images/auto5.jpg" width="280" height="180" alt="" />
						<p>
							Wypożyczalnia samochodów Samochody24 cechuje się wysoką jakością oferowanych samochodów. Wszystkie nasze pojazdy są nowe: najstarszy model ma 2 lata. Ze szczególną starannością dbamy o sprawność techniczną pojazdów, dlatego stale przeprowadzamy przeglądy techniczne w autoryzowanych serwisach.
						</p>
					</div>
					<div id="content">
						<div id="box1">
							<h2>
								Witamy w Samochody24.pl
							</h2>
							<img class="left" src="images/auto3.jpg" width="250" height="190" alt="" />
							<p>
							Samochody24 to wypożyczalnia samochodów, która umożliwia sprawny wynajem 
							samochodu aż w 26 miastach Polski. Nowoczesny konfigurator internetowy daje możliwość wyboru auta odpowiadającego bieżącym potrzebom – od ekonomicznego samochodu klasy A, poprzez komfortowe sedany i SUV-y, aż po samochody dostawcze i busy. 
							Do dyspozycji klientów są samochody z automatyczną i manualną skrzynią biegów. Samochody są w pełni sprawne, gwarantując bezpieczeństwo kierowcy i pasażerom.
							W zależności od modelu oferowane auta wyposażone są we wszystkie udogodnienia – klimatyzację, system nawigacji GPS, tempomat i system Auto Start Stop. Zobacz ofertę specjalną wypożyczalni samochodów Automarzeń24
							</p>
						</div>
						<div id="box2">
							<h3>
								3 powody dlaczego powinieneś nas wybrać :
							</h3>
							<ul class="imageList">
								<li class="first">
									<img class="left" src="images/auto4.jpg" width="200" height="150" alt="" />
									<p>✪Posiadamy nowe samochody.</p>
								</li>
								<li>
									<img class="left" src="images/auto2.jpg" width="200" height="150" alt="" />
									<p>✪Zapewniamy atrakcyjne ceny.</p>
								</li>
								<li class="last">
									<img class="left" src="images/auto6.jpg" width="200" height="150" alt="" />
									<p>✪Nasze samochody są bezpieczne.</p>
								</li>
							</ul>
						</div>
						
					</div>
					<br class="clear" />
				</div>
				
			</div>
		
		</div>
	</body>
</html>

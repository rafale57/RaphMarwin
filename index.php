<?php
require 'lib/autoload.php';
include('lib/InfosInscription.php');

$db = DBFactory::getMysqlConnexionAvecMySQLI();
$manager = new GestionUtilisateurMYSQLI($db);
$confirm = new InfosInscription();

$up= new RecupUserPodcast($db);



if(isset($_POST['inscrire'])) {
	
	
	$pseudo= mysqli_real_escape_string($db,$_POST['pseudo']);
	$mdp=$_POST['mdp'];
	    $aqa= $confirm->crypt($mdp);

$mdpcrypte= $aqa['mdp'];
$cell= $aqa['cell'];


$email=  mysqli_real_escape_string($db,$_POST['email']);
$nom= mysqli_real_escape_string($db,$_POST['nom']) ;
$prenom=  mysqli_real_escape_string($db,$_POST['prenom']);

$instanceUtilisateur=new Utilisateur($pseudo,  $mdpcrypte, $email,$nom , $prenom, $cell );
//print_r( $instanceUtilisateur);
$manager->add($instanceUtilisateur);
$manager->arraypref($pseudo);
$confirm->ConfirmationInscription($db,$pseudo,$email);
	

}

if(isset($_POST['connecter'])) {
	
	$pseudoConnect= mysqli_real_escape_string($db,$_POST['pseudo2']);
$mdpConnect=mysqli_real_escape_string($db,$_POST['mdp2']);

	
	if($manager->connexion($pseudoConnect,$mdpConnect) == TRUE   ){

		//verifCompteValide($pseudo);
		$unesession=new Session(); // le constructeur crée une session_start();
		$unesession->startsession();
	$xxx=$up->RecupUtilisateur("prenom");
		echo '<br/>';
		var_dump($xxx);
		echo '<br/>';
		$unesession->__set($pseudoConnect,$pseudoConnect);
	
		echo "TEST vous etes connecté : " .$unesession->__get($pseudoConnect);
		
		
	
}else echo 'Les identifiants ne sont pas corrects !';

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>PodcastToi - Wanna try a little podcast</title>
	<meta property="og:title" content="PodcastToi - Wanna try a podcast "/>  <!-- nom  -->
	<meta property="og:type" content="website"/>
	<meta property="og:url" content=" "/> <!-- url -->
	<meta property="og:image" content=" "/> <!-- logo  -->
	<meta property="og:site_name" content="PodcastToi"/>
	<meta property="og:description" content=" PodcastToi - Enfin un site qui centralise tous vos poscasts musicals"/>
	<meta name="description" content="PodcastToi - Enfin un site qui centralise tous vos poscasts musicals" />
	<meta name="keywords" content="PodcastToi, podcast, Musique,centraliser  ">	
	<meta name="author" content="PodcastToi" />
		<link rel="shortcut icon" href="/favicon.ico">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- FAVICON & FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Scada:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<!-- CSS -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="http://static.neko-san.fr/css/neko.min.css" rel="stylesheet" type="text/css" media="all" />	
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.js"></script>
		<script src="js/testformulaire.js"></script>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Montserrat:400,700' rel='stylesheet' type='text/css'>
	
</head>


<body>
	<div id="body">
		<!-- HEADER -->
<div id="top"></div>
<div id="header">
	<div id="logo">
		<a href="/"><img class="logo" src="  img\logo1.png " width="80" height="80" alt="logo" /></a>  <!-- image -->
		<h1><span>PodcastToi </span><br>Wanna try a podcast?</h1>
	</div>
	
	<div id="menu">
		<div class="menu-btn"><a href="#"><i class="fa fa-navicon"></i><span class="label">Menu</span></a></div>
		<div class="nav">
			<a class= "select" href="  ">Accueil</a>
			<a  class="popup-button" data-modal="popup_inscription"> Inscription </a>
			<a  class="popup-button" data-modal="popup_connexion"> Connexion </a>
			<a  href="/FAQ.php">FAQ</a>
			<a  href="/contact.php">Contact</a>	
		</div>
			
			<div class="share">
			<img src="img/B_deco.png" width="50" height="50"/> 
			<img src="img/img-titre.png" width="50" height="50"/> 
		</div>
			</div>
</div>





		<!-- LE CONTENU DE LA POPUP -->

		<div class="modal blur-effect" id="popup_inscription">
			<div class="popup-content">
				<h3>Inscrivez-vous</h3>
				<div>
					<p class="para">L'inscription vous permettra de profiter de nos podcasts</p>
					<form method="POST" id="Verif" name="Verif" onSubmit="return VerifMail();">
					<input type="text" name="pseudo" placeholder="pseudo" required />
						<input type="password" name="mdp" required />
						<input type="email" name="email" placeholder="Adresse email" required />
					<input type="text" name="nom" placeholder="votre nom" required />
					<input type="text" name="prenom" placeholder="votre prénom" required/>
					
				
					
					
					<input type="submit" class="submit" value="je m'inscris" name="inscrire" />
					</form>
					<div class="close"></div>
				</div>
			</div>
		</div>
		
		
		<div class="modal blur-effect" id="popup_connexion">
			<div class="popup-content">
				<h3>Connectez-vous</h3>
				<div>
					<form method="post" action="index.php" >
					<input type="text" name="pseudo2" placeholder="pseudo" required/>
					<input type="password" name="mdp2"required />
					<input type="submit" class="submit" name="connecter" value="je me connecte" required/>
					</form>
					<div class="close"></div>
				</div>
			</div>
		</div>
		

		<!-- FIN DE LA POPUP -->
		
		<!-- CONTENU DE LA PAGE -->

		<div class="container">

			<div class="content">

			

			</div><!-- .content -->
				
		</div><!-- .container -->

		<!-- FIN DU COTENU DE LA PAGE -->

		<div class="overlay"></div><!-- La div overlay -->
		
		<!-- Le script qui crée la popup -->
		<script src="js/popup.js"></script>

		<!-- Pour l'effet blur -->
		<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
		<script>
			// this is important for IEs
			var polyfilter_scriptpath = '/js/';
		</script>
		<script src="js/cssParser.js"></script>
		<script src="js/css-filters-polyfill.js"></script>
	</body>





<div class="clear"></div>

		</div>
		<div id="footer">
		<div id="chat" class="closed">
		<div class="chat-header"><i class="fa fa-weixin"></i></div>
		<div class="chat-content"></div>
	</div>
	
	<div >
		<h1>Partenaires</h1>
			<h1>Suivez nous sur les reseaux sociaux</h1>
		<div class="share">
			<a href="https://www.facebook.com/NekoSanOfficiel" target="_blank"><div class="sprite bt_share facebook"></div></a>
			<a href="https://twitter.com/NekoSanOfficiel" target="_blank"><div class="sprite bt_share twitter"></div></a>
			<a href="http://neko-san.fr/rss.xml" target="_blank"><div class="sprite bt_share rss"></div></a>
		</div>
	</div>
	
	<div class="footer-widget radio col-lg-4 col-sm-6 col-xxs-12">

			</div>
	
	<div class="footer-widget stats col-lg-3 col-xxs-12">
		<h1>Statistiques</h1>
		<p class="col-lg-12 col-sm-4 col-xxs-12">
	
		</p>
		
	</div>
	
	<div class="clear"></div>
	
	<div class="credit col-xxs-12">
		<h1>PodcastToi</h1>
		<p>Ce site vous est fourni par Marwin NIMESKERN et toute son équipe. Copyright © | 2015</p>
	</div>
	<div class="clear"></div>
</div>	</div>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js" defer></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" defer></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.0/jquery.nicescroll.min.js" defer></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.1/chosen.jquery.min.js" defer></script>
	<script type="text/javascript" src='https://www.google.com/recaptcha/api.js' defer></script>
			<script type="text/javascript" src="/ressources/timeline" defer></script>
				<script type="text/javascript" src="http://www.adcash.com/script/java.php?option=rotateur&r=111335" defer></script>
	<script type="text/javascript">//<![CDATA[ 
		var shortest = {
			"config": {
				"token": "a815f5249c305beb12c41d8afb214293",
				"excludeDomains": [
					"yourowndomain.com"
				],
				"entryScript": {
				
					"timeout": "3000"
					},
				"capping": {
					"limit": 1,
					"timeout": 24
				},
				"overlayActivated": true
			}
		};
		(function() {
		   var script = document.createElement('script');
		   script.async = true;
		   script.src = '//cdn.shorte.st/link-converter.min.js';
		   var entry = document.getElementsByTagName('script')[0];
		   entry.parentNode.insertBefore(script, entry);
		})();
	//]]></script>       
		<script type="text/javascript" src="http://static.neko-san.fr/js/neko.min.js" defer></script>
	</body>
</html>



	

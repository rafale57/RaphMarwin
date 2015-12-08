function VerifChamps()
{

		b = document.Verif.pseudo.value;
	valide0 = false;
	
		if(b.length>=4) {
			valide0=true;
		}
			
			
		
	if(valide0==false) { 
		alert("Votre pseudo est trop court !");
	return valide0;
	
	}
	
	
	
		c = document.Verif.mdp.value;
	valide3 = false;
	
		if(c.length>=6) {
			valide3=true;
		}
			
			
		
	if(valide3==false) { 
		alert("Votre mot de passe  est trop court, il vous faut 6 caractères minimum !");
	return valide3;
	
	}

	a = document.Verif.email.value;
	valide1 = false;
	for(var j=1;j<(a.length);j  ) {
		if(a.charAt(j)=='@') {
			if(j<(a.length-4)) {
				for(var k=j;k<(a.length-2);k  ) {
					if(a.charAt(k)=='.') valide1=true;
				}
			}
		}
	}
	
	if(valide1==false) { 
		alert("Veuillez saisir une adresse email valide.");
	return valide1;
	}
	
	
	}
	
	
	
	

	
//-->

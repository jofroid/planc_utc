<?php

	class Mail {

		function __construct (){
		$this->db = Atomik::get('db');
		}



		public function send_match_mail($name_user1,$name_user2,$mail)
        {

        	$passage_ligne = "\r\n";
        	 
        	$to      = $mail;
		    $subject = "Félicitation ! Vous avez une compatibilité !";

			$header = "From: \"Wink\"<wink@assos.utc.fr>".$passage_ligne;
			$header.= "Reply-to: \"Wink\" <wink@assos.utc.fr>".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header .= "Content-Type: text/html; charset=\"UTF-8\"";

			$message_txt = "Bonjour ".$name_user1.", Vous avez une compatibilité avec ".$name_user2.". Vous pouvez partager depuis le site votre";
			$message = "<html><head></head><body><h2>Vous avez une compatibilité !</h2>
				<p>Bonjour ".$name_user1.", Vous avez une compatibilité avec ".$name_user2.". 
				Il est maintenant temps de prendre contact avec la personne si vous le souhaitez, en partageant par exemple votre numéro de portable.</p>
				<p><a href='' >Partager mon numéro de portable</a></p>

				<p>A bientôt sur Wink!</p>
			 

			 </body></html>";

			
			 mail($to, $subject, $message, $header);
        }
	};
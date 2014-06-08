var CheminRepertoire;
jQuery(document).ready(function(){
 
    serveur = "http://" + location.host;
    var CheminComplet = document.location.href;
    CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
    
});







 

function send_Wink(loginDestinataire,tuile_wink)
{
	var xhr_send = new XMLHttpRequest();

        xhr_send.open('GET', CheminRepertoire + '/?action=sendWink&logindest=' + loginDestinataire );
        xhr_send.onreadystatechange = function()
        {
            if (xhr_send.readyState == 4 && xhr_send.status == 200)
            {
                if(xhr_send.responseText == "ok")
                {
                        //document.getElementById('modal_match_body') = "Vous venez de matcher avec " + loginDestinataire + " ! Félicitations :)";
                     $('#modal_match').modal('toggle');
                }
                update_picture_wink(loginDestinataire);
                if(tuile_wink.className == "tuile-wink-red")
                {
                    tuile_wink.className = "tuile-wink";
                }
                else
                {
                    tuile_wink.className = "tuile-wink-red";
                }
                
                console.log(xhr_send.responseText);
            }
             else if(xhr_send.readyState == 4 && xhr_send.status != 200) 
             { // En cas d'erreur !
     
                     alert('Une erreur est survenue !\n\nCode :' + xhr_send.status + '\nTexte : ' + xhr_send.statusText);
             }
        };
 
        xhr_send.send(null);
}

function update_picture_wink(loginDestinataire)
{

}
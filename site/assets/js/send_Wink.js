var CheminRepertoire;
jQuery(document).ready(function(){
 
    serveur = "http://" + location.host;
    var CheminComplet = document.location.href;
    CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
    
});







 

function send_Wink(loginDestinataire,tuile,image,prenom_element)
{
	var xhr_send = new XMLHttpRequest();
        xhr_send.withCredentials = true;
        xhr_send.open('GET', CheminRepertoire + '/ajax/sendwink?logindest=' + loginDestinataire );
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
                if(tuile.className == "tuile")
                {
                    tuile.className = "sw-tuile";
                    image.className = "sw-tuile-img";
                    prenom_element.className = "sw-tuile-title";
                }
                else
                {
                    tuile.className = "tuile";
                    image.className = "tuile-img";
                    prenom_element.className = "tuile-title";
                }
                
                console.log(xhr_send.responseText);
            }
             else if(xhr_send.readyState == 4 && xhr_send.status != 200) 
             { // En cas d'erreur !
     
                     alert('Une erreur est survenue !\n\nCode :' + xhr_send.status + '\nTexte : ' + xhr_send.statusText);
             }
        };
        xhr_send.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr_send.send(null);
}

function update_picture_wink(loginDestinataire)
{

}
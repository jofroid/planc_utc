var CheminRepertoire;
jQuery(document).ready(function(){
 
    serveur = "http://" + location.host;
    var CheminComplet = document.location.href;
    CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
    
});









function send_Wink(loginDestinataire)
{
	var xhr_send = new XMLHttpRequest();

        xhr_send.open('POST', CheminRepertoire + '/?action=sendWink');
        xhr_send.onreadystatechange = function()
        {
            if (xhr_send.readyState == 4 && xhr_send.status == 200)
            {
                update_picture_wink(loginDestinataire);
                console.log(xhr_send.responseText);
            }
             else if(xhr_send.readyState == 4 && xhr_send.status != 200) 
             { // En cas d'erreur !
     
                     alert('Une erreur est survenue !\n\nCode :' + xhr_send.status + '\nTexte : ' + xhr_send.statusText);
             }
        };
 
        xhr_send.send("loginDestinataire=" + loginDestinataire);
}

function update_picture_wink(loginDestinataire)
{
    alert(loginDestinataire);
}
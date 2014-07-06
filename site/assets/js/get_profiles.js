var CheminRepertoire;
jQuery(document).ready(function(){
 
    serveur = "http://" + location.host;
    var CheminComplet = document.location.href;
    CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
    get_profiles();
});



function get_profiles()
{
	var xhr_refresh = new XMLHttpRequest();
    xhr_refresh.withCredentials = true;
    
        xhr_refresh.open('GET', CheminRepertoire + '/ajax/profiles');
        xhr_refresh.onreadystatechange = function()
        {
            if (xhr_refresh.readyState == 4 && xhr_refresh.status == 200)
            {
                 var profiles = JSON.parse(xhr_refresh.responseText);

                   if(profiles[0]["number"] > 0)
                   {
                        analyze_profile(profiles);
                   }
                

            }
             else if(xhr_refresh.readyState == 4 && xhr_refresh.status != 200) 
             { // En cas d'erreur !
     
                     alert('Une erreur est survenue !\n\nCode :' + xhr_refresh.status + '\nTexte : ' + xhr_refresh.statusText);
             }
        };
    xhr_refresh.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr_refresh.send(null);
 
}


function analyze_profile(profiles)
{
	for(var i=1; i<=profiles[0]["number"]; i++)
    {
        display_profile(profiles[i]["login"],profiles[i]["prenom"],profiles[i]["semestre"],profiles[i]["source"], profiles[i]["wink_login"]);
    }
}

function display_profile(login,prenom, semestre, image_src, wink_login)
{
	//var element = document.createElement('div');
    var tuile = document.createElement('div');
	var prenom_element = document.createElement('span');
    var image =document.createElement('img');
    //var tuile_wink = document.createElement('div');

    //element.className = "tuile-center";
    tuile.className = "tuile";
    prenom_element.className ="tuile-title";
    
    image.className = "tuile-img";

    prenom_element.innerText = prenom;
    if(wink_login == null)
    {

    }
    else
    {
        tuile.className = "sw-tuile";
        image.className = "sw-tuile-img";
        prenom_element.className = "sw-tuile-title";
    }


   
    image.src= CheminRepertoire + "/assets/images/profile_picture/" + image_src +'.jpg';

    //element.appendChild(tuile);
    tuile.appendChild(image);
    tuile.appendChild(prenom_element);
   // tuile.appendChild(tuile_wink);


	document.getElementById('main').appendChild(tuile);
     tuile.addEventListener('click', function(){
                          send_Wink(login,tuile, image,prenom_element);
        
                          
                         });

}
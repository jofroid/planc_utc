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

        xhr_refresh.open('GET', CheminRepertoire + '/?action=get_profiles');
        xhr_refresh.onreadystatechange = function()
        {
            if (xhr_refresh.readyState == 4 && xhr_refresh.status == 200)
            {
                 alert(xhr_refresh.responseText);
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
 
        xhr_refresh.send(null);
 
        return xhr_refresh;
}


function analyze_profile(profiles)
{
	for(var i=1; i<=profiles[0]["number"]; i++)
    {
        display_profile(profiles[i]["prenom"],profiles[i]["semestre"],profiles[i]["source"]);
    }
}

function display_profile(prenom, semestre, image_src)
{
	var element = document.createElement('div');
	var prenom_element = document.createElement('div');
    var semestre = document.createElement('div');
    var image =document.createElement('img');

    prenom_element.innerText = prenom;
    semestre.innerText = semestre; 
    //image.src= image_src;

    //element.appendChild(image);
    element.appendChild(prenom_element);
    element.appendChild(semestre);
	document.getElementById('main').appendChild(element);

}
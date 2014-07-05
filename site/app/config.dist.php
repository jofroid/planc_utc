<?php

Atomik::set(array(

    'plugins' => array(
        'DebugBar' => array(
            // if you don't include jquery yourself as it is done in the
            // skeleton, comment out this line (the debugbar will include jquery)
            'include_vendors' => 'css'
        ),
        'Errors' => array(
            'catch_errors' => true
        ),
        'Session',
        'Flash',
        'Controller'
    ),

    'app.layout' => '_layout',

    // WARNING: change this to false when in production
    'atomik.debug' => true
));
// Connexion à la base de données
Atomik::set('plugins.Db', array(
    'dsn' => 'mysql:host=localhost;dbname=plancutc',
    'username' => 'root',
    'password' => ''
));


Atomik::set(array(
        // Activation de l'URL Rewriting
        'atomik.url_rewriting' => true,
        // Adresse de base de Wink
        'atomik.base_url' => 'http://127.0.0.1/planc_utc/site/'
        ));

Atomik::set(array(
        // URL vers le CAS
        'cas_url' => 'https://cas.utc.fr/cas/',
        // Temps limite d'attente
        'cas_timeout' => '10',
        // URL vers le serveur Ginger
        'ginger_server' =>  'http://127.0.0.1/faux-ginger/index.php/v1/',
        // Clé d'accès de l'application Wink à Ginger
        'ginger_apikey' => 'fauxginger' ));

<?php 
require '/app/classes/backend.class.php';
Atomik::redirect('?forbidden=1&action=index');
$backend = new Backend_profils();
list($logins,$prenoms,$noms) = $backend->get_profile_correspond();

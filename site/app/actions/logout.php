<?php
require '/config.php';

unset($_SESSION['nom']);
unset($_SESSION['login']);
unset($_SESSION['prenom']);
unset($_SESSION['adulte']);
unset($_SESSION['mail']);
header("Location: https://cas.utc.fr/cas/logout?url=".urlencode($_CONFIG["self_url"]."?logout=1"));
<?php
require '/config.php';

unset($_SESSION['login']);
header("Location: https://cas.utc.fr/cas/logout?url=".urlencode($_CONFIG["self_url"]."?logout=1"));
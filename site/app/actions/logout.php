<?php
unset($_SESSION['username']);
unset($_SESSION['login']);
header("Location: https://cas.utc.fr/cas/logout?url=".urlencode("http://localhost:8080/PlancUTC/planc_utc/site/?logout=1"));
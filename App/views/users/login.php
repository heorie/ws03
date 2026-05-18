<?php

$base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
header('Location: ' . $base . '/public/login');
exit;
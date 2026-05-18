<?php
/**
 * This file should NOT be accessed directly.
 * All routing goes through public/index.php
 * This redirect is a safety fallback only.
 */
$base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
header('Location: ' . $base . '/public/register');
exit;
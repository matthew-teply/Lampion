<?php
$rustart = getrusage();
session_start();

unset($_SESSION['Lampion']['queryCount']);

# Configs
require_once 'config/config.php';
require_once 'config/config.defaults.php';

# Loading all necessary classes
require_once 'vendor/autoload.php';
require_once 'kernel/Bootstrap.php';

$ru = getrusage();
\Lampion\Core\Runtime::rutime($ru, $rustart, "utime");
\Lampion\Core\Runtime::rutime($ru, $rustart, "stime");

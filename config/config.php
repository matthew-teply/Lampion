<?php

# Core framework paths
define('ROOT', getcwd() . "/");
define('WEB_ROOT', $_SERVER['HTTP_HOST'] . "/");

define('CORE', "core/");
define('APP', "app/");
define('CONFIG', "config/");
define('TOOLS', 'tools/');

# App paths
define('SRC', "/src/");
define('CONTROLLERS', "/src/Controller/");
define('MODELS', "/src/Model/");
define('OBJECTS', "/src/Entity/");
define('TEMPLATES', "/public/templates/");

define('ASSETS', "/public/assets/");
define('CSS', ASSETS . "css/");
define('IMG', ASSETS . "images/");
define('SCRIPTS', ASSETS . "scripts/");

define('DATA', "/data/");
define('LANGUAGE', DATA . "language/");
define('SQL', DATA . "sql/");
define('STORAGE', DATA . "storage/");

# Files
define('MAX_FILESIZE', 1000000000000);

# HTTP codes
define('HTTP_NOT_FOUND', 404);
define('HTTP_FORBIDDEN', 403);
define('HTTP_UNAUTHORIZED', 401);
define('HTTP_INTERNAL_ERROR', 500);
define('HTTP_OK', 200);

# Error redirects
define('HTTP_NOT_FOUND_REDIR', '404');
define('HTTP_FORBIDDEN_REDIR', '403');
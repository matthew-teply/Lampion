<?php

namespace Lampion\Application;

use Dotenv\Dotenv;
use Lampion\Core\Session;

class ApplicationManager
{
    public static function init() {
        $app = Session::get("Lampion")['app'];

        # App configs
        $dotenv = Dotenv::create(APP . $app);
        $dotenv->load();

        require_once  APP . "$app/config/config.php";
        require_once  APP . "$app/config/config.defaults.php";

        if(isset($_GET['url'])) {
            $_GET['url'] = rtrim($_GET['url'], '/'); // Remove trailing slashes from URL
    
            # If the first URL param is the app's name, remove it
            if(explode("/", $_GET['url'])[0] == $app && sizeof(explode("/", $_GET['url'])) > 1) {
                $_GET['url'] = explode("$app/", $_GET['url'])[1];
            }
    
            # Set default homepage
            if(!isset($_GET['url']) || $_GET['url'] == $app) {
                $_GET['url'] = DEFAULT_HOMEPAGE;
            }
        }

        else {
            $_GET['url'] = DEFAULT_HOMEPAGE;
        }

        # Require app.php, where app gets configured and all the routes get registered
        require_once APP . "$app/app.php";
    }
}
<?php

namespace Lampion\View;

use Lampion\Controller\ControllerLoader;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Markup;
use Lampion\Http\Url;
use Twig\TwigFunction;

class View {

    private $twig;
    private $app;
    private $isPlugin;

    /**
     * View constructor.
     * @param string $templateFolder
     * @param string $app
     * @param bool   $isPlugin
     */
    public function __construct(string $templateFolder, string $app, bool $isPlugin = false)
    {
        $loader = new FilesystemLoader(strtolower($templateFolder));
        $this->twig = new Environment($loader);
        
        $pathFunc = new TwigFunction('path', function($route) {
            return Url::link($route);
        });

        $this->twig->addFunction($pathFunc);

        $this->app = strtolower($app);
        $this->isPlugin = $isPlugin;
    }

    /**
     * Renders a templates
     * @param string $path
     * @param array  $args
     * @return $this
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $path, array $args = []) {
        if($this->isPlugin) {
            $initialPath = PLUGINS;
        }

        else {
            $initialPath = APP;
        }

        $args['__css__']     = WEB_ROOT . $initialPath . $this->app . CSS;
        $args['__scripts__'] = WEB_ROOT . $initialPath . $this->app . SCRIPTS;
        $args['__img__']     = WEB_ROOT . $initialPath . $this->app . IMG;
        $args['__webRoot__'] = WEB_ROOT;

        echo $this->twig->render("$path.twig", !empty($args) ? $args : get_object_vars($this));

        return $this;
    }

    /**
     * Loads a templates, if a Controller with the same directory path is found, it is used to render the templates with variables inserted
     * @param string $path
     * @param array  $args
     * @param bool   $rawTemplate
     * @param string $app
     * @return Markup
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function load(string $path, array $args = [], bool $rawTemplate = false) {
        $loader = new ControllerLoader($this->app);

        if($loader->controller($path) && !$rawTemplate) {
            ob_start();
                echo $loader->controller($path)->index();
            return new Markup(ob_get_clean(), 'UTF-8');
        }

        else {
            if($this->isPlugin) {
                $initialPath = PLUGINS;
            }
    
            else {
                $initialPath = APP;
            }

            $args['__css__']     = WEB_ROOT . $initialPath . $this->app . CSS;
            $args['__scripts__'] = WEB_ROOT . $initialPath . $this->app . SCRIPTS;
            $args['__img__']     = WEB_ROOT . $initialPath . $this->app . IMG;
            $args['__webRoot__'] = WEB_ROOT;

            return new Markup($this->twig->render("$path.twig", $args), 'UTF-8');
        }
    }
}
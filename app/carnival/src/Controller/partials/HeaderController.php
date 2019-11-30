<?php
namespace Carnival\Controller;

use Lampion\Controller\ControllerBase;

class HeaderController extends ControllerBase
{
    public function index()
    {
        $view = $this->load()->view();

        $view->url = $_GET['url'];

        $view->render("partials/header");
    }
}
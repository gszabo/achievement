<?php

namespace Achie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AchieFrontendBundle:Default:index.html.twig');
    }
}

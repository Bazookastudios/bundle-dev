<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      //redirect to the admin page
      return $this->redirectToRoute('bazookas_admin_homepage');
    }
}

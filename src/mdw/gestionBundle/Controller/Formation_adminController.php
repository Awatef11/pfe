<?php

namespace mdw\gestionBundle\Controller;

use mdw\gestionBundle\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Formation controller.
 *
 */
class Formation_adminController extends Controller
{

    public function afficheDemandeAction(){


        $this->render('gestionBundle:Formation_admin:afficheDemande.html.twig');


    }



}

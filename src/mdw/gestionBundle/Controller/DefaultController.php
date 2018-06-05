<?php

namespace mdw\gestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{


    public function rechercheAction(Request $request){

        if ($request->isMethod('post')){

            $mot = $request->request->get('recherche');

            $em = $this->getDoctrine()->getManager();

            $personnes = $em->getRepository('gestionBundle:Personne')->findBy(array('prenom' => $mot));

            $formations = $em->getRepository('gestionBundle:Formation')->findBy(array('formation' => $mot));



            return $this->render(':default:recherche_resultat.html.twig', array('formations' => $formations, 'personnes' => $personnes));

        }


        return $this->render(':default:recherche_formation.html.twig');

    }


    public function indexAction()
    {
        return $this->render('gestionBundle:Default:index.html.twig');
    }
    
     public function indAction()
    {
       
        return $this->render('mdwgestionBundle:Default:ind.html.twig');
    }
    public function accueil_adminAction()
    {

        return $this->render('accueil_admin.html.twig');
    }
    public function accueil_userAction()
    {

        return $this->render('mdwgestionBundle:Default:accueil_user.html.twig');
    }
   
}


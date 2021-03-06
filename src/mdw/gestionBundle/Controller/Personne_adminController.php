<?php

namespace mdw\gestionBundle\Controller;

use mdw\gestionBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Personne controller.
 *
 */
class Personne_adminController extends Controller
{
    /**
     * Lists all personne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personnes = $em->getRepository('gestionBundle:Personne')->findAll();

        return $this->render('gestionBundle:Personne_admin:index.html.twig', array(
            'personnes' => $personnes,
        ));
    }

    /**
     * Creates a new personne entity.
     *
     */
    public function newAction(Request $request)
    {
        $personne = new Personne();
        $form = $this->createForm('mdw\gestionBundle\Form\PersonneType', $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            return $this->redirectToRoute('admin_personne_show', array('id' => $personne->getId()));
        }

        return $this->render('gestionBundle:Personne_admin:new.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a personne entity.
     *
     */
    public function showAction(Personne $personne)
    {
        $deleteForm = $this->createDeleteForm($personne);

        return $this->render('gestionBundle:Personne_admin:show.html.twig', array(
            'personne' => $personne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing personne entity.
     *
     */
    public function editAction(Request $request, Personne $personne)
    {
        $deleteForm = $this->createDeleteForm($personne);
        $editForm = $this->createForm('mdw\gestionBundle\Form\PersonneType', $personne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_personne_edit', array('id' => $personne->getId()));
        }

        return $this->render('gestionBundle:Personne_admin:edit.html.twig', array(
            'personne' => $personne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a personne entity.
     *
     */
    public function deleteAction(Request $request, Personne $personne)
    {
        $form = $this->createDeleteForm($personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personne);
            $em->flush();
        }

        return $this->redirectToRoute('admin_personne_index');
    }

    /**
     * Creates a form to delete a personne entity.
     *
     * @param Personne $personne The personne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Personne $personne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_personne_delete', array('id' => $personne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

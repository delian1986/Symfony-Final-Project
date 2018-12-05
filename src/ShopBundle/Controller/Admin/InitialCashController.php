<?php

namespace ShopBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShopBundle\Entity\InitialCash;
use ShopBundle\Form\AddInitialCashType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InitialCashController
 * @package ShopBundle\Controller
 * @Route("initial-cash")
 * @Security("is_granted('ROLE_ADMIN')")
 *
 * Initial cash for all users. The default value of 0.00 is set by Fixture
 */
class InitialCashController extends Controller
{
    /**
     * @Route("/add",name="add_initial_cash")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addInitialCashToUsers(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $initialCash = $em->getRepository(InitialCash::class)->getOldInitialCash();
        $form = $this->createForm(AddInitialCashType::class, $initialCash);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $initialCashRows = count($em->getRepository(InitialCash::class)->findAll());

            if ($initialCashRows === 1) {
                $oldInitialCash = $em->getRepository(InitialCash::class)->getOldInitialCash();

                //remove old initial cash
                $em->remove($oldInitialCash);
                $em->flush();

                //set new initial cash
                $em->persist($initialCash);
                $em->flush();

                return $this->redirectToRoute('add_initial_cash');
            }
        }

        return $this->render('admin/initial_cash/add_cash.html.twig', ['form' => $form->createView()]);
    }
}
<?php

namespace App\Controller;

use App\Entity\Claim;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClaimController extends AbstractController
{
    /**
     * @Route("/claim", name="claim")
     */
    public function findClaimByCategory (Request $request){

        $request = $this->transformJsonBody($request);
        $category = $request->get('category');
        if($category != null) {
            $result=$this->getDoctrine()->getRepository(Claim::class)->findBy(array('category'=>$category));
        }
        if ($result == null) {
            return $this->createNotFoundException('No Claims under category' . $category);
        }
    }

}

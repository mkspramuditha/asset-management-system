<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Asset;
use AppBundle\Entity\Product;
use AppBundle\Form\AssetType;
use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/asset")
 */
class ProductController extends DefaultController
{
    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(Request $request){
        $asset = new Asset();
        $form = $this->createForm(AssetType::class,$asset);
        $form->handleRequest($request);
            
        if($form->isSubmitted()){
            $today = new \DateTime();
            $user = $this->getUser();
            $asset->setCreatedAt($today);
            $asset->setLastUpdatedAt($today);
            $asset->setCreatedBy($user);
            $asset->setLastUpdatedBy($user);
            $asset->setActive(true);
            $this->insert($asset);
            return $this->redirectToRoute('product_list');
        }

        return $this->render(':default:product_add.html.twig',array(
           'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/list", name="product_list")
     */
    public function listAction(Request $request){
        $assets = $this->getRepository('Asset')->findBy(array(),array('active'=>'ASC'));

        return $this->render('default/product_list.html.twig',array(
           'assets'=>$assets
        ));

    }

    /**
     * @Route("/edit/{id}", name="product_edit")
     */
    public function editAction(Request $request,$id){
        $asset = $this->getRepository('Asset')->find($id);
        $form = $this->createForm(AssetType::class,$asset);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $today = new \DateTime();
            $user = $this->getUser();
            $asset->setLastUpdatedAt($today);
            $asset->setLastUpdatedBy($user);
            $this->insert($asset);
            return $this->redirectToRoute('product_list');

        }
        return $this->render(':default:product_edit.html.twig',array(
            'form'=>$form->createView(),
            'asset'=>$asset
        ));
    }

    /**
     * @Route("/view/{id}", name="product_view")
     */
    public function viewAction(Request $request,$id){
        $asset = $this->getRepository('Asset')->find($id);
        
        return $this->render(':default:product_view.html.twig',array(
            'asset'=>$asset
        ));
    }

    /**
     * @Route("/remove/{id}", name="product_remove")
     */
    public function removeAction(Request $request,$id){
        $asset = $this->getRepository('Asset')->find($id);
        if($asset != null){
            if($asset->getActive()){
                $asset->setActive(false);
            }else{
                $asset->setActive(true);
            }
            $today = new \DateTime();
            $user = $this->getUser();
            $asset->setLastUpdatedAt($today);
            $asset->setLastUpdatedBy($user);
            $this->insert($asset);
        }

        return $this->redirectToRoute('product_list');
    }

    /**
     * @Route("/view/specification/{id}", name="view_specification")
     */
    public function viewSpecification(Request $request,$id){
        $asset = $this->getRepository('Asset')->find($id);
        if($asset != null){
            return new Response($asset->getHtml());
        }
        return $this->redirectToRoute('product_list');
    }
}

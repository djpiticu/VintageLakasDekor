<?php

namespace App\Controller\Shop;

use App\Entity\Product\Product;
use App\Model\PreviewContent;
use App\Services\StoreSettings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function showHomepage(Request $request, StoreSettings $settings)
    {
        // Ideiglenes atiranyitas a Blog-oldalra
        return $this->redirectToRoute('site-article-list');

        $previewMode = $request->query->get(PreviewContent::PREVIEW_TOKEN);
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->fetchVisibleProducts(12);
        return $this->render('webshop/site/homepage.html.twig', [
            'products' => $products,
            'previewMode' => isset($previewMode) ? true : false,
        ]);
    }


    /**
     * @Route("/404", name="404")
     */
    public function show404()
    {
        return $this->render('webshop/site/404.html.twig');
    }



}

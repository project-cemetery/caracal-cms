<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Product;
use AppBundle\Entity\Setting;
use AppBundle\Entity\TemplateImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $settingsRepo = $this->getDoctrine()->getRepository(Setting::class);

        $companyName =    $settingsRepo->findOneBy(['type' => Setting::COMPANY_NAME_TYPE])->getBody();
        $companyTagline = $settingsRepo->findOneBy(['type' => Setting::COMPANY_TAGLINE_TYPE])->getBody();
        $seoTitle =       $settingsRepo->findOneBy(['type' => Setting::SEO_TITLE_TYPE])->getBody();
        $seoKeywords =    $settingsRepo->findOneBy(['type' => Setting::SEO_KEYWORDS_TYPE])->getBody();
        $seoDescription = $settingsRepo->findOneBy(['type' => Setting::SEO_DESCRIPTION_TYPE])->getBody();
        $gaID           = $settingsRepo->findOneBy(['type' => Setting::GOOGLE_ANALYTICS_ID_TYPE])->getBody();

        $currentYear = date('Y');

        $products = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(['enabled' => true]);

        $contactsRepo = $this->getDoctrine()->getRepository(Contact::class);

        $phone   = $contactsRepo->findOneBy(['type' => Contact::PHONE_TYPE])->getBody();
        $email   = $contactsRepo->findOneBy(['type' => Contact::EMAIL_TYPE])->getBody();
        $address = $contactsRepo->findOneBy(['type' => Contact::ADDRESS_TYPE])->getBody();

        $imagesRepo = $this->getDoctrine()->getRepository(TemplateImage::class);

        $logo    = $imagesRepo->findOneBy(['type' => TemplateImage::LOGO_TYPE])->getImage();
        $favicon = $imagesRepo->findOneBy(['type' => TemplateImage::FAVICON_TYPE])->getImage();
        $map     = $imagesRepo->findOneBy(['type' => TemplateImage::MAP_TYPE])->getImage();

        dump($products);

        return $this->render(
            'index.html.twig',
            [
                'companyName'    => $companyName,
                'companyTagline' => $companyTagline,
                'seo'            => [
                    'title'       => $seoTitle,
                    'keywords'    => $seoKeywords,
                    'description' => $seoDescription,
                ],
                'gaID'           => $gaID,
                'year'           => $currentYear,
                'products'       => $products,
                'contacts'       => [
                    'phone'   => $phone,
                    'email'   => $email,
                    'address' => $address,
                ],
                'images'         => [
                    'logo'    => $logo,
                    'favicon' => $favicon,
                    'map'     => $map,
                ],
            ]
        );
    }
}

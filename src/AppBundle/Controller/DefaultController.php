<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gallery;
use AppBundle\Entity\Product;
use AppBundle\Entity\Setting;
use AppBundle\Entity\TemplateImage;
use AppBundle\Entity\Ticket;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var Form $form */
        $form = $this
            ->createFormBuilder()
            ->setAction($this->generateUrl('homepage'))
            ->setMethod('POST')
            ->add('name', TextType::class, ['attr' => ['placeholder'  => 'Имя']])
            ->add('email', EmailType::class, ['attr' => ['placeholder'  => 'Email']])
            ->add('message', TextareaType::class,
                [
                    'attr' => [
                        'placeholder'  => 'Сообщение',
                        'rows'         => 8,
                    ],
                ]
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Отправить',
                'attr'  => [
                    'class' => 'send-btn',
                ]
            ])
            ->getForm();

        $newTicket = false;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $ticket = (new Ticket())
                ->setCustomerName($data['name'])
                ->setCustomerEmail($data['email'])
                ->setCustomerMessage($data['message']);

            $em = $this->getDoctrine()->getManager();

            $em->persist($ticket);
            $em->flush();

            $newTicket = true;
        }

        $products = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(['enabled' => true]);

        $photos = $this
            ->getDoctrine()
            ->getRepository(Gallery::class)
            ->findGeneral();

        $galleries = $this
            ->getDoctrine()
            ->getRepository(Gallery::class)
            ->findAll();

        return $this->render(
            '@THEME/index.html.twig',
            [
                'products'  => $products,
                'newTicket' => $newTicket,
                'form'      => $form->createView(),
                'photos'    => $photos,
                'galleries' => $galleries,
            ]
        );
    }

    /**
     * @Route("/gallery/{id}", name="gallery")
     */
    public function galleryAction($id)
    {
        return $this->render(
            '@THEME/gallery.html.twig',
            [
                'gallery' => null,
            ]
        );
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function productAction($id)
    {
        $settingsRepo = $this->getDoctrine()->getRepository(Setting::class);

        $companyName = $settingsRepo->findOneBy(['type' => Setting::COMPANY_NAME_TYPE])->getBody();
        $gaID        = $settingsRepo->findOneBy(['type' => Setting::GOOGLE_ANALYTICS_ID_TYPE])->getBody();
        $seoKeywords = $settingsRepo->findOneBy(['type' => Setting::SEO_KEYWORDS_TYPE])->getBody();

        $imagesRepo = $this->getDoctrine()->getRepository(TemplateImage::class);

        $logo    = $imagesRepo->findOneBy(['type' => TemplateImage::LOGO_TYPE])->getImage();
        $favicon = $imagesRepo->findOneBy(['type' => TemplateImage::FAVICON_TYPE])->getImage();
        $map     = $imagesRepo->findOneBy(['type' => TemplateImage::MAP_TYPE])->getImage();

        $currentYear = date('Y');

        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        return $this->render(
            '@THEME/product.html.twig',
            [
                'product'     => $product,
                'companyName' => $companyName,
                'seoKeywords'    => $seoKeywords,
                'images'      => [
                    'logo'    => $logo,
                    'favicon' => $favicon,
                    'map'     => $map,
                ],
                'gaID'        => $gaID,
                'year'        => $currentYear,
            ]
        );
    }
}

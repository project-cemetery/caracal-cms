<?php

namespace AppBundle\Services\Listeners;



use AppBundle\Entity\BottomLink;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Setting;
use AppBundle\Entity\TemplateImage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class TwigGlobalVars
{
    protected $twig;
    protected $em;

    public function __construct(EntityManager $entityManager, \Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->em = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $vars = [];

        $vars = array_merge($vars, $this->getContacts());
        $vars = array_merge($vars, $this->getBottomLinks());
        $vars = array_merge($vars, $this->getImages());
        $vars = array_merge($vars, $this->getSettings());

        foreach ($vars as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }
    }

    private function getContacts()
    {
        $contactsRepo = $this->em->getRepository(Contact::class);

        /** @var Contact $vkLink */
        $vkLink = $contactsRepo->findOneBy(['type' => Contact::VK_TYPE]);
        /** @var Contact $phone */
        $phone =  $contactsRepo->findOneBy(['type' => Contact::PHONE_TYPE]);
        /** @var Contact $email */
        $email = $contactsRepo->findOneBy(['type' => Contact::EMAIL_TYPE]);
        /** @var Contact $address */
        $address = $contactsRepo->findOneBy(['type' => Contact::ADDRESS_TYPE]);

        return [
            'contact_vkLink'  => $vkLink->getBody(),
            'contact_phone'   => $phone->getBody(),
            'contact_email'   => $email->getBody(),
            'contact_address' => $address->getBody(),
        ];
    }

    private function getBottomLinks()
    {
        $links = $this->em
            ->getRepository(BottomLink::class)
            ->findAll();

        usort($links, function (BottomLink $a, BottomLink $b) {
            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });

        return [
            'bottomLinks' => $links,
        ];
    }

    private function getImages()
    {
        $imagesRepo = $this->em->getRepository(TemplateImage::class);

        $logo    = $imagesRepo->findOneBy(['type' => TemplateImage::LOGO_TYPE])->getImage();
        $favicon = $imagesRepo->findOneBy(['type' => TemplateImage::FAVICON_TYPE])->getImage();
        $map     = $imagesRepo->findOneBy(['type' => TemplateImage::MAP_TYPE])->getImage();

        return [
            'image_logo'    => $logo,
            'image_favicon' => $favicon,
            'image_map'     => $map,
        ];
    }

    private function getSettings()
    {
        $settingsRepo = $this->em->getRepository(Setting::class);

        $companyName    = $settingsRepo->findOneBy(['type' => Setting::COMPANY_NAME_TYPE])->getBody();
        $companyTagline = $settingsRepo->findOneBy(['type' => Setting::COMPANY_TAGLINE_TYPE])->getBody();
        $seoTitle       = $settingsRepo->findOneBy(['type' => Setting::SEO_TITLE_TYPE])->getBody();
        $seoKeywords    = $settingsRepo->findOneBy(['type' => Setting::SEO_KEYWORDS_TYPE])->getBody();
        $seoDescription = $settingsRepo->findOneBy(['type' => Setting::SEO_DESCRIPTION_TYPE])->getBody();
        $gaID           = $settingsRepo->findOneBy(['type' => Setting::GOOGLE_ANALYTICS_ID_TYPE])->getBody();

        return [
            'setting_companyName'     => $companyName,
            'setting_companyTagline'  => $companyTagline,
            'setting_seo_title'       => $seoTitle,
            'setting_seo_keywords'    => $seoKeywords,
            'setting_seo_description' => $seoDescription,
            'setting_gaID'            => $gaID,
        ];
    }
}
<?php

namespace AppBundle\Command;


use AppBundle\DBAL\EnumContactType;
use AppBundle\DBAL\EnumSettingType;
use AppBundle\DBAL\EnumTemplateImageType;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Setting;
use AppBundle\Entity\TemplateImage;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeployCommand extends ContainerAwareCommand
{
    const DIVIDER = '--------';

    protected function configure()
    {
        $this
            ->setName('app:deploy')
            ->setDescription('Prepare entities for deployment');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $newSettingTypes = $this->createSettings($em);
        $newContactsTypes = $this->createContacts($em);
        $newTemplateImages = $this->createTemplateImages($em);

        if ($newSettingTypes) {
            $output->writeln('Created settings:');
            $output->writeln($newSettingTypes);
            $output->writeln(self::DIVIDER);
        }

        if ($newContactsTypes) {
            $output->writeln('Created contacts:');
            $output->writeln($newContactsTypes);
            $output->writeln(self::DIVIDER);
        }

        if ($newTemplateImages) {
            $output->writeln('Created template images:');
            $output->writeln($newTemplateImages);
            $output->writeln(self::DIVIDER);
        }

        $output->writeln('All done!');
    }

    private function createSettings(EntityManager $em)
    {
        return $this->createEntities(
            $em,
            Setting::class,
            EnumSettingType::VALUES,
            function (Setting $s) {
                return $s->getType();
            },
            function (string $type) {
                return (new Setting())
                    ->setType($type)
                    ->setBody('default');
            }
        );
    }

    private function createContacts(EntityManager $em)
    {
        return $this->createEntities(
            $em,
            Contact::class,
            EnumContactType::VALUES,
            function (Contact $c) {
                return $c->getType();
            },
            function (string $type) {
                return (new Contact())
                    ->setType($type)
                    ->setBody('default');
            }
        );
    }

    private function createTemplateImages($em)
    {
        return $this->createEntities(
            $em,
            TemplateImage::class,
            EnumTemplateImageType::VALUES,
            function (TemplateImage $ti) {
                return $ti->getType();
            },
            function (string $type) {
                return (new TemplateImage())
                    ->setType($type)
                    ->setImage('default');
            }
        );
    }

    private function createEntities(
        EntityManager $em,
        string $className,
        array $types,
        callable $getTypeCallback,
        callable $createEntityCallback
    ) {
        $existedTypes = array_map(
            $getTypeCallback,
            $em->getRepository($className)->findAll()
        );

        $newTypes = [];

        foreach ($types as $type) {
            if (!in_array($type, $existedTypes)) {
                $entity = $createEntityCallback($type);

                $newTypes[] = $getTypeCallback($entity);
                $em->persist($entity);
            }
        }

        $em->flush();

        return $newTypes;
    }
}
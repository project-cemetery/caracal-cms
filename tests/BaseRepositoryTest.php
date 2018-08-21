<?php

namespace App\Tests;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;

abstract class BaseRepositoryTest extends KernelTestCase
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var array */
    private $fixtures = [];

    public function __construct(array $fixtureClasses, ...$args)
    {
        $this->fixtures = (function (string ...$fixtureClasses) {
            return $fixtureClasses;
        })(...$fixtureClasses);

        parent::__construct(...$args);
    }

    /**
     * {@inheritdoc}
     *
     * @group legacy
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel
            ->getContainer()
            ->get('doctrine')
            ->getManager();

        $application = new Application($kernel);
        $application->setAutoExit(false);
        $application->run(new StringInput('doctrine:database:create'));
        $application->run(new StringInput('doctrine:schema:update --force'));

        $fixtureExecutor = new ORMExecutor(
            $this->entityManager,
            new ORMPurger($this->entityManager)
        );

        $fixtureLoader = new ContainerAwareLoader($kernel->getContainer());

        foreach ($this->fixtures as $fixtureClass) {
            /** @var FixtureInterface $fixture */
            $fixture = $kernel->getContainer()->get($fixtureClass);
            $fixtureLoader->addFixture($fixture);
        }

        $fixtureExecutor->execute($fixtureLoader->getFixtures());
    }

    protected function getRepository(string $class)
    {
        return $this->entityManager->getRepository($class);
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}

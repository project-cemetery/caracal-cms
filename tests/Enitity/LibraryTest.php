<?php

namespace App\Tests\Enitity;


use App\Entity\Library;
use PHPUnit\Framework\TestCase;

class LibraryTest extends TestCase
{
    public function testCreateEmpty()
    {
        $lib = Library::createEmpty();

        $this->assertGreaterThan(1, mb_strlen($lib->getId()));
        $this->assertNull($lib->getName());
        $this->assertNull($lib->getDescription());
        $this->assertNull($lib->getParent());
        $this->assertCount(0, $lib->getChildren());
    }

    public function testCreateWithDescription()
    {
        $lib = Library::create('name', 'description');

        $this->assertGreaterThan(1, mb_strlen($lib->getId()));
        $this->assertEquals('name', $lib->getName());
        $this->assertEquals('description', $lib->getDescription());
        $this->assertNull($lib->getParent());
        $this->assertCount(0, $lib->getChildren());
    }

    public function testCreateWithoutDescription()
    {
        $lib = Library::create('name');

        $this->assertGreaterThan(1, mb_strlen($lib->getId()));
        $this->assertEquals('name', $lib->getName());
        $this->assertNull($lib->getDescription());
        $this->assertNull($lib->getParent());
        $this->assertCount(0, $lib->getChildren());
    }

    public function testRename()
    {
        $lib = Library::create('old name');

        $lib->rename('new name');
        
        $this->assertEquals('new name', $lib->getName());
        $this->assertNull($lib->getDescription());
    }

    public function testChangeDescription()
    {
        $lib = Library::create('old name', 'old description');

        $lib->changeDescription('new description');

        $this->assertEquals('old name', $lib->getName());
        $this->assertEquals('new description', $lib->getDescription());
    }

    public function testChangeParentFromNull()
    {
        $lib = Library::createEmpty();

        $parent = Library::createEmpty();

        $lib->changeParent($parent);

        $this->assertEquals($parent, $lib->getParent());
        $this->assertCount(1, $parent->getChildren());
    }

    public function testChangeParentFromExist()
    {
        $lib = Library::createEmpty();

        $oldParent = Library::createEmpty();
        $lib->changeParent($oldParent);

        $newParent = Library::createEmpty();

        $lib->changeParent($newParent);

        $this->assertEquals($newParent, $lib->getParent());
        $this->assertCount(0, $oldParent->getChildren());
        $this->assertCount(1, $newParent->getChildren());
    }

    public function testOrphan()
    {
        $lib = Library::createEmpty();

        $parent = Library::createEmpty();
        $lib->changeParent($parent);

        $lib->orphan();

        $this->assertCount(0, $parent->getChildren());
        $this->assertNull($lib->getParent());
    }

    public function testAddOrphanChild()
    {
        $lib = Library::createEmpty();

        $child = Library::createEmpty();

        $lib->addChild($child);

        $this->assertCount(1, $lib->getChildren());
        $this->assertEquals($lib, $child->getParent());
    }

    public function testAddChildWithExistParent()
    {
        $lib = Library::createEmpty();

        $child = Library::createEmpty();
        $oldParent = Library::createEmpty();
        $child->changeParent($oldParent);

        $lib->addChild($child);

        $this->assertEquals($lib, $child->getParent());
        $this->assertCount(1, $lib->getChildren());
        $this->assertCount(0, $oldParent->getChildren());
    }

    public function testRemoveChild()
    {
        $lib = Library::createEmpty();

        $child = Library::createEmpty();
        $lib->addChild($child);

        $lib->removeChild($child);

        $this->assertNull($child->getParent());
        $this->assertCount(0, $lib->getChildren());
    }
}
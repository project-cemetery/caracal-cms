<?php

namespace App\Tests\Library;

use App\Business\Library\Article;
use App\Business\Library\Library;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testCreateEmpty()
    {
        $article = Article::createEmpty('id1');

        $this->assertGreaterThan(1, mb_strlen($article->getId()));
        $this->assertNull($article->getName());
        $this->assertNull($article->getBody());
        $this->assertNull($article->getDescription());
        $this->assertNull($article->getLibrary());
    }

    public function testCreateWithDescription()
    {
        $article = Article::create('id1', 'name', 'body', 'description');

        $this->assertGreaterThan(1, mb_strlen($article->getId()));
        $this->assertEquals('name', $article->getName());
        $this->assertEquals('body', $article->getBody());
        $this->assertEquals('description', $article->getDescription());
        $this->assertNull($article->getLibrary());
    }

    public function testCreateWithoutDescription()
    {
        $article = Article::create('id1', 'name', 'body');

        $this->assertGreaterThan(1, mb_strlen($article->getId()));
        $this->assertEquals('name', $article->getName());
        $this->assertEquals('body', $article->getBody());
        $this->assertNull($article->getDescription());
        $this->assertNull($article->getLibrary());
    }

    public function testRename()
    {
        $article = Article::create('id1', 'old name', 'old body');

        $article->rename('new name');

        $this->assertEquals('new name', $article->getName());
    }

    public function testChangeBody()
    {
        $article = Article::create('id1', 'old name', 'old body', 'old description');

        $article->changeBody('new body');

        $this->assertEquals('new body', $article->getBody());
        $this->assertEquals('old description', $article->getDescription());
    }

    public function testChangeDescription()
    {
        $article = Article::create('id1', 'old name', 'old body', 'old description');

        $article->changeDescription('new description');

        $this->assertEquals('old body', $article->getBody());
        $this->assertEquals('new description', $article->getDescription());
    }

    public function testMoveOrphanToLibrary()
    {
        $article = Article::createEmpty('id1');

        $lib = Library::createEmpty('idLib');

        $article->moveToLibrary($lib);

        $this->assertCount(1, $lib->getArticles());
        $this->assertEquals($lib, $article->getLibrary());
    }

    public function testMoveFromOneLibraryToAnother()
    {
        $article = Article::createEmpty('id1');

        $oldLib = Library::createEmpty('idLib');
        $article->moveToLibrary($oldLib);

        $newLib = Library::createEmpty('idLib');

        $article->moveToLibrary($newLib);

        $this->assertCount(1, $newLib->getArticles());
        $this->assertEquals($newLib, $article->getLibrary());
        $this->assertCount(0, $oldLib->getArticles());
    }

    public function testRemoveFromLibrary()
    {
        $article = Article::createEmpty('id1');

        $lib = Library::createEmpty('idLib');
        $article->moveToLibrary($lib);

        $article->removeFromLibrary();

        $this->assertNull($article->getLibrary());
        $this->assertCount(0, $lib->getArticles());
    }
}

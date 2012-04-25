<?php
// src/Blogger/BlogBundle/Tests/Controller/PageControllerTest.php

namespace Blogger\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        $this->assertEquals(1, $crawler->filter('h1:contains("About symblog")')->count());
    }
	public function testIndex()
{
    $client = static::createClient();

    $crawler = $client->request('GET', '/');

    // Check there are some blog entries on the page
    $this->assertTrue($crawler->filter('article.blog')->count() > 0);
}
}


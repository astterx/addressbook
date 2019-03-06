<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PersonControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();
        // Create a new entry in the database
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /person/");
        $crawler = $client->click($crawler->selectLink('Create a new person')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Add person')->form(array(
            'appbundle_person[firstname]'  => 'Sandu',
            'appbundle_person[lastname]'  => 'Velea',
            'appbundle_person[address]'  => 'Stefan cel Mare 16',
            'appbundle_person[city]'  => 'Bucharest',
            'appbundle_person[zipcode]'  => '12345',
            'appbundle_person[country]'  => 'RO',
            'appbundle_person[phone]'  => '0760123123',
        ));

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirection());
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Sandu")')->count(), 'Missing element td:contains("Sandu")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Save')->form(array(
            'appbundle_person[field_name]'  => 'Alex',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Alex"]')->count(), 'Missing element [value="Alex"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Alex/', $client->getResponse()->getContent());
    }
}

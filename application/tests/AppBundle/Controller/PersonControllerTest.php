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
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /");
        $crawler = $client->click($crawler->selectLink('Create a new person')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Add person')->form(array(
            'appbundle_person[firstname]'  => 'Test',
            'appbundle_person[lastname]'  => 'Test_Lastname',
            'appbundle_person[address]'  => 'Stefan cel Mare 16',
            'appbundle_person[city]'  => 'Bucharest',
            'appbundle_person[zipcode]'  => '12345',
            'appbundle_person[country]'  => 'RO',
            'appbundle_person[phone]'  => '0760123123',
            'appbundle_person[birthday][year]'  => '1987',
            'appbundle_person[birthday][month]'  => '10',
            'appbundle_person[birthday][day]'  => '12',
            'appbundle_person[email]'  => 'test@yahoo.com',
        ));

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirection());
        $crawler = $client->followRedirect();

        $crawler = $client->click($crawler->selectLink('Back to the list')->link());
        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('edit')->link());

        $form = $crawler->selectButton('Save')->form(array(
            'appbundle_person[firstname]'  => 'Alex',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Alex"
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Alex")')->count(), 'Missing element td:contains("Alex")');

        $crawler = $client->click($crawler->selectLink('show')->link());
        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Alex/', $client->getResponse()->getContent());
    }
}

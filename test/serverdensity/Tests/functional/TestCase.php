<?php
namespace serverdensity\Tests\Functional;

use serverdensity\Client;
use serverdensity\Exception\ApiLimitExceedException;
use serverdensity\Exception\InvalidTokenException;

/**
 * @group functional
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $client;
    public function setUp()
    {
        // You have to specify authentication here to run full suite
        $client = new Client();
        $client->authenticate('auth_token_here');

        try {
            $client->api('user')->all();
        } catch (ApiLimitExceedException $e) {
            $this->markTestSkipped('API limit reached. Skipping to prevent unnecessary failure.');
        } catch (InvalidTokenException $e) {
            $this->markTestSkipped('Test requires authentication. Skipping to prevent unnecessary failure.');
        }
        $this->client = $client;
    }
}

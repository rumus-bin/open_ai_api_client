<?php

namespace Http;

use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Nyholm\NSA;
use RumusBin\OpenAiApiClient\Http\ClientConfig;
use RumusBin\OpenAiApiClient\Tests\ApiTestCase;

class ClientConfigTest extends ApiTestCase
{
    public function testAppendPlugin(): void
    {
        $clientConfig = new ClientConfig('dummy_api_key');
        $plugin0 = new HeaderAppendPlugin(['plugin0']);

        $clientConfig->appendPlugin($plugin0);
        $plugins = NSA::getProperty($clientConfig, 'appendPlugins');
        $this->assertCount(1, $plugins);
        $this->assertEquals($plugin0, $plugins[0]);

        $plugin1 = new HeaderAppendPlugin(['plugin1']);
        $clientConfig->appendPlugin($plugin1);
        $plugins = NSA::getProperty($clientConfig, 'appendPlugins');
        $this->assertCount(2, $plugins);
        $this->assertEquals($plugin1, $plugins[1]);
    }

    public function testPrependPlugin(): void
    {
        $clientConfig = new ClientConfig('dummy_api_key');
        $plugin0 = new HeaderAppendPlugin(['plugin0']);

        $clientConfig->prependPlugin($plugin0);
        $plugins = NSA::getProperty($clientConfig, 'prependPlugins');
        $this->assertCount(1, $plugins);
        $this->assertEquals($plugin0, $plugins[0]);

        $plugin1 = new HeaderAppendPlugin(['plugin1']);
        $clientConfig->prependPlugin($plugin1);
        $plugins = NSA::getProperty($clientConfig, 'prependPlugins');
        $this->assertCount(2, $plugins);
        $this->assertEquals($plugin1, $plugins[0]);
    }

}
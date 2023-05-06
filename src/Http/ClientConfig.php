<?php

namespace RumusBin\OpenAiApiClient\Http;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

final class ClientConfig
{
    public const HEADER_KEY_CONTENT_TYPE = 'Content-type';
    public const HEADER_KEY_ACCEPT = 'Accept';
    public const HEADER_KEY_AUTHORIZATION= 'Authorization';
    public const HEADER_KEY_OPEN_AI_ORGANIZATION= 'OpenAI-Organization';


    private string $baseEndpoint = 'https://api.openai.com';
    private string $version = 'v1';

    private string $apiKey;

    private readonly ?ClientInterface $httpClient;

    private readonly ?UriFactoryInterface $uriFactory;

    private ?string $organizationId = null;

    private PluginClient $configuredClient;

    private bool $configurationModified = true;

    /**
     * @var Plugin[]
     */
    private array $prependPlugins = [];

    /**
     * @var Plugin[]
     */
    private array $appendPlugins = [];

    public function __construct(
        string $apiKey,
        ?ClientInterface $httpClient = null,
         ?UriFactoryInterface $uriFactory = null,
        ?string $organizationId = null
    ) {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->uriFactory = $uriFactory ?? Psr17FactoryDiscovery::findUriFactory();
        $this->organizationId = $organizationId;
    }

    public function createConfiguredClient(): PluginClient
    {
        if ($this->configurationModified) {
            $this->configurationModified = false;
            $plugins = $this->prependPlugins;
            $plugins[] = new Plugin\BaseUriPlugin($this->getBaseEndpoint());
            $plugins[] = new Plugin\HeaderDefaultsPlugin([
                self::HEADER_KEY_CONTENT_TYPE => 'application/json',
                self::HEADER_KEY_ACCEPT => 'application/json, text/plain, */*',
                self::HEADER_KEY_AUTHORIZATION => 'Bearer ' . $this->apiKey,
            ]);

            $this->organizationId && $plugins[] = new Plugin\HeaderDefaultsPlugin([
                self::HEADER_KEY_OPEN_AI_ORGANIZATION => $this->organizationId,
            ]);

            $this->configuredClient = new PluginClient(
                $this->httpClient,
                \array_merge($plugins, $this->appendPlugins)
            );
        }

        return $this->configuredClient;
    }

    public function setBaseEndpoint(string $endpoint): void
    {
        $this->baseEndpoint = $endpoint;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function appendPlugin(Plugin ...$plugin): void
    {
        $this->configurationModified = true;
        foreach ($plugin as $p) {
            $this->appendPlugins[] = $p;
        }
    }

    public function prependPlugin(Plugin ...$plugin): void
    {
        $this->configurationModified = true;
        $plugin = \array_reverse($plugin);
        foreach ($plugin as $p) {
            \array_unshift($this->prependPlugins, $p);
        }
    }

    /**
     * Remove a plugin by its fully qualified class name (FQCN).
     */
    public function removePlugin(string $fqcn): void
    {
        foreach ($this->prependPlugins as $idx => $plugin) {
            if ($plugin instanceof $fqcn) {
                unset($this->prependPlugins[$idx]);
                $this->configurationModified = true;
            }
        }

        foreach ($this->appendPlugins as $idx => $plugin) {
            if ($plugin instanceof $fqcn) {
                unset($this->appendPlugins[$idx]);
                $this->configurationModified = true;
            }
        }
    }

    public function getBaseEndpoint(): UriInterface
    {
        return $this->uriFactory->createUri(sprintf('%s/%s', $this->baseEndpoint, $this->version));
    }


    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $organizationId
     */
    public function setOrganizationId(string $organizationId): void
    {
        $this->organizationId = $organizationId;
    }
}
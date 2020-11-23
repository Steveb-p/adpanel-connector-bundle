<?php

namespace Enzode\AdPanelConnector\Bundle\Tests;

use Enzode\AdPanelConnector\Bundle\AdPanelConnectorBundle;
use Enzode\AdPanelConnector\Client\AdTredoClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class AdPanelConnectorBundleTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return AdPanelConnectorTestKernel::class;
    }

    /**
     * @covers \Enzode\AdPanelConnector\Bundle\AdPanelConnectorBundle
     * @covers \Enzode\AdPanelConnector\Bundle\DependencyInjection\AdPanelConnectorExtension
     */
    public function testKernelCanBeBuilt(): void
    {
        self::bootKernel();
        self::assertInstanceOf(AdPanelConnectorTestKernel::class, self::$kernel);
        self::assertInstanceOf(AdTredoClient::class, self::$container->get('test.enzode.adpanel_connector.adpanel_connector'));
    }
}

class AdPanelConnectorTestKernel extends Kernel
{

    public function registerBundles()
    {
        return [
            new AdPanelConnectorBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(static function (ContainerBuilder $container): void {
            $container
                ->setAlias(
                    'test.enzode.adpanel_connector.adpanel_connector',
                    'enzode.adpanel_connector.adpanel_connector'
                )
                ->setPublic(true)
            ;
        });
    }
}

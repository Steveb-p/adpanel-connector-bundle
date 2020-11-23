<?php
declare(strict_types=1);

use Enzode\AdPanelConnector\Client\AdTredoClient;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function(ContainerConfigurator $configurator): void {

    $parameters = $configurator->parameters();

    $parameters->set('enzode.adpanel_connector.api_key', '');
    $parameters->set('enzode.adpanel_connector.adtredo_url', 'https://adtredo.ch');

    $services = $configurator->services();

    $services
        ->set('enzode.adpanel_connector.adpanel_connector', AdTredoClient::class)
        ->factory([AdTredoClient::class, 'createDefault'])
        ->private()
    ;

    $services->alias(AdTredoClient::class, 'enzode.adpanel_connector.adpanel_connector');
};

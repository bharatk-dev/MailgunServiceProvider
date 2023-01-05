<?php

/**
 * MailgunServiceProvider
 *
 * A Simple wrapper for the mailgun API for the Silex Framework
 *
 * @package		MailgunServiceProvider
 * @author		Achraf Soltani <achraf.soltani@gmail.com>
 * @date        05/19/2015
 * @file        MailgunServiceProvider.php
 */
 

namespace AchrafSoltani\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use AchrafSoltani\Mailgun\Client;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Hydrator\ArrayHydrator;

/**
 * Class MailgunServiceProvider
 * @package AchrafSoltani\Provider
 */
class MailgunServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        
         $app['mailgun'] = $app->protect(function () use ($app)
        {
            $configurator = new HttpClientConfigurator();
            $configurator->setApiKey($app['mailgun.api_key']);
            $configurator->setDebug($app['mailgun.debug']);

            $client = new Client($configurator, new ArrayHydrator());
            $client->setWorkingDomain($app['mailgun.domain']);
            return $client;
        });
    }
    
    public function boot(Application $app)
    {
        
    }
}

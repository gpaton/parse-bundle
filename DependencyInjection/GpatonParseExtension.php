<?php

namespace Gpaton\ParseBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 */
class GpatonParseExtension extends ConfigurableExtension
{
    protected function loadInternal(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('gpaton_parse.app_id', $config['app_id']);
        $container->setParameter('gpaton_parse.rest_key', $config['rest_key']);
        $container->setParameter('gpaton_parse.master_key', $config['master_key']);
    }

    public function getAlias()
    {
        return 'gpaton_parse';
    }
}

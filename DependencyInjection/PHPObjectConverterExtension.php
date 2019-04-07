<?php

namespace Baudev\PHPObjectConverterBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PHPObjectConverterExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        //var_dump($container->getParameter(''));die();
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('php_object_converter.generate_command');
        $definition->setArgument(1, $config['ignore_annotations']);
        $definition->setArgument(2, $config['enable_annotations']);
        $definition->setArgument(3, $config['attributes']['add_private']);
        $definition->setArgument(4, $config['attributes']['add_protected']);
    }
}
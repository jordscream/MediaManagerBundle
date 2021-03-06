<?php

namespace Ylly\MediaManagerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;

use Symfony\Component\DependencyInjection\Parameter;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class YllyMediaManagerExtension extends Extension
{
	
	public  function load(array $config, ContainerBuilder $container)
	{
		// set Parameters
		$config = $config[0];
		
		$container->setParameter('media_manager.manager.namespace', 'Ylly\MediaManagerBundle\Entity\MediaManager');
		$container->setParameter('media_manager.media.namespace', 'Ylly\MediaManagerBundle\Entity\Media');
		
		if (isset($config['class']) && isset($config['class']['manager']))
		  $container->setParameter('media_manager.manager.namespace', $config['class']['manager']);
        if (isset($config['class']) && isset($config['class']['media']))		  
		  $container->setParameter('media_manager.media.namespace',   $config['class']['media']);
		
		
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load("orm.xml");
	}
	
    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://symfony.com/schema/dic/media_manager';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension.ExtensionInterface::getAlias()
     *
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return 'ylly_media_manager';
    }	
}
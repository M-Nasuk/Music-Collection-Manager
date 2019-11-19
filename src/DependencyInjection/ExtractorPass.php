<?php


namespace App\DependencyInjection;


use App\Service\ExtractManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ExtractorPass
 * @package App\DependencyInjection
 */
class ExtractorPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ExtractManager::class)) {
            return;
        }

        $definition = $container->findDefinition(ExtractManager::class);

        $taggedServices = $container->findTaggedServiceIds('extract.generator');

        foreach ($taggedServices as $id => $tags) {
            $definition->addArgument(new Reference($id));
        }
    }
}
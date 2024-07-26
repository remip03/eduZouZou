<?php

namespace ContainerRwdEY5M;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getNelmioApiDoc_RouteDescribers_RouteArgumentService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'nelmio_api_doc.route_describers.route_argument' shared service.
     *
     * @return \Nelmio\ApiDocBundle\RouteDescriber\RouteArgumentDescriber
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'RouteDescriber'.\DIRECTORY_SEPARATOR.'RouteDescriberInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Describer'.\DIRECTORY_SEPARATOR.'ModelRegistryAwareInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'RouteDescriber'.\DIRECTORY_SEPARATOR.'RouteDescriberTrait.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Describer'.\DIRECTORY_SEPARATOR.'ModelRegistryAwareTrait.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'nelmio'.\DIRECTORY_SEPARATOR.'api-doc-bundle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'RouteDescriber'.\DIRECTORY_SEPARATOR.'RouteArgumentDescriber.php';

        return $container->privates['nelmio_api_doc.route_describers.route_argument'] = new \Nelmio\ApiDocBundle\RouteDescriber\RouteArgumentDescriber(($container->privates['argument_metadata_factory'] ??= new \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory()), new RewindableGenerator(function () use ($container) {
            yield 0 => ($container->privates['nelmio_api_doc.route_argument_describer.map_query_string'] ??= new \Nelmio\ApiDocBundle\RouteDescriber\RouteArgumentDescriber\SymfonyMapQueryStringDescriber());
            yield 1 => ($container->privates['nelmio_api_doc.route_argument_describer.map_request_payload'] ??= new \Nelmio\ApiDocBundle\RouteDescriber\RouteArgumentDescriber\SymfonyMapRequestPayloadDescriber());
            yield 2 => ($container->privates['nelmio_api_doc.route_argument_describer.map_query_parameter'] ??= new \Nelmio\ApiDocBundle\RouteDescriber\RouteArgumentDescriber\SymfonyMapQueryParameterDescriber());
        }, 3));
    }
}

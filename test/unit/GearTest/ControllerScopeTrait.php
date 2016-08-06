<?php
namespace GearTest;

trait ControllerScopeTrait
{
    public function getControllerScope($srcType)
    {
        return [
            /**
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicDependencies%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree'
                ***REMOVED***),
                'basic-dependencies'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicDependency%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepository'

                ***REMOVED***),
                'basic-dependency'
            ***REMOVED***,
            */
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFactoryNamespace%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType),
                    'type' => $srcType,
                    'namespace' => 'Another\Long\Namespaces',
                    'service' => 'factories'

                ***REMOVED***),
                'basic-factory-namespace'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFactory%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType),
                    'type' => $srcType,
                    'service' => 'factories'
                ***REMOVED***),
                'basic-factory'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType),
                    'type' => $srcType,
                    'namespace' => 'Another\Long\Namespaces'
                ***REMOVED***),
                'basic-namespace'
            ***REMOVED***,

            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType),
                    'type' => $srcType
                ***REMOVED***),
                'basic'
            ***REMOVED***
        ***REMOVED***;
    }
}

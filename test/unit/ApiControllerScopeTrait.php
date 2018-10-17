<?php
namespace GearTest;

trait ApiControllerScopeTrait
{
    public function getControllerScope($srcType)
    {
        $manyActions = [
            [
                'name' => 'Get'
            ***REMOVED***,
            [
                'name' => 'GetList'
            ***REMOVED***,
            [
                'name' => 'Update'
            ***REMOVED***,
            [
                'name' => 'Delete'
            ***REMOVED***,
            [
                'name' => 'Create'
            ***REMOVED***,
       ***REMOVED***;



        return [
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicDependenciesFactoryMany%s', $srcType),
                    'type' => $srcType,
                    'actions' => $manyActions,
                    'service' => 'factories',
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree'
                ***REMOVED***),
                'basic-dependencies-factory-many'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFactoryDependencies%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree',
                    'service' => 'factories'
                ***REMOVED***),
                'basic-factory-dependencies'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFactoryDependency%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepository',
                    'service' => 'factories'

                ***REMOVED***),
                'basic-factory-dependency'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFactoryNamespace%s', $srcType),
                    'type' => $srcType,
                    'namespace' => 'Another\Long\Namespaces',
                    'service' => 'factories'

                ***REMOVED***),
                'basic-factory-namespace'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFactory%s', $srcType),
                    'type' => $srcType,
                    'service' => 'factories'
                ***REMOVED***),
                'basic-factory'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicList%s', $srcType),
                    'type' => $srcType,
                    'actions' => [
                        [
                            'name' => 'GetList'
                        ***REMOVED***
                    ***REMOVED***
                ***REMOVED***),
                'basic-list'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicImplements%s', $srcType),
                    'type' => $srcType,
                    'implements' => 'Repository\RepositoryInterface'

                ***REMOVED***),
                'basic-implements'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicMany%s', $srcType),
                    'type' => $srcType,
                    'actions' => $manyActions
                ***REMOVED***),
                'basic-many'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicNamespace%s', $srcType),
                    'type' => $srcType,
                    'namespace' => 'Another\Long\Namespaces',
                ***REMOVED***),
                'basic-namespace'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'type' => $srcType
                ***REMOVED***),
                'basic'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'type' => $srcType,
                    'namespace' => 'CompleteController',
                    'extends' => 'Controller\BasicController'
                ***REMOVED***),
                'basic-namespace-extends'
            ***REMOVED***,
        ***REMOVED***;
    }
}

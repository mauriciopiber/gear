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
                'name' => 'Post'
            ***REMOVED***,
       ***REMOVED***;



        return [
          /*
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
                    'name' => sprintf('BasicDependenciesFactoryFirst%s', $srcType),
                    'type' => $srcType,
                    'actions' => [
                        [
                            'name' => 'GetList'
                        ***REMOVED***
                    ***REMOVED***,
                    'service' => 'factories',
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree'
                ***REMOVED***),
                'basic-dependencies-factory-first'
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
                    'name' => sprintf('BasicDependenciesMany%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree',
                    'actions' => $manyActions
                ***REMOVED***),
                'basic-dependencies-many'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicFirst%s', $srcType),
                    'type' => $srcType,
                    'actions' => [
                        [
                            'name' => 'GetList'
                        ***REMOVED***
                    ***REMOVED***
                ***REMOVED***),
                'basic-first'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicDependencyFirst%s', $srcType),
                    'type' => $srcType,
                    'actions' => [
                        [
                            'name' => 'GetList'
                        ***REMOVED***
                    ***REMOVED***,
                    'dependency' => 'Repository\MyRepository',
                ***REMOVED***),
                'basic-dependency-first'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('BasicDependenciesFirst%s', $srcType),
                    'type' => $srcType,
                    'actions' => [
                        [
                            'name' => 'GetList',
                        ***REMOVED***
                    ***REMOVED***,
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree'
                ***REMOVED***),
                'basic-dependencies-first'
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
                    'name' => sprintf('BasicDependencies%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepositoryOne,Repository\MyRepositoryTwo,Repository\MyRepositoryThree'
                ***REMOVED***),
                'basic-dependencies'
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
                    'name' => sprintf('BasicDependency%s', $srcType),
                    'type' => $srcType,
                    'dependency' => 'Repository\MyRepository'

                ***REMOVED***),
                'basic-dependency'
            ***REMOVED***,
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'type' => $srcType,
                    'namespace' => 'Another\Long\Namespaces',
                    'actions' => [
                        [
                            'name' => 'GetList',
                        ***REMOVED***
                    ***REMOVED***,
                ***REMOVED***),
                'basic-namespace'
            ***REMOVED***,
            */
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'type' => $srcType
                ***REMOVED***),
                'basic'
            ***REMOVED***,
        ***REMOVED***;
    }
}

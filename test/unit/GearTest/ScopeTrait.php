<?php
namespace GearTest;

use Symfony\Component\Yaml\Parser;

trait ScopeTrait
{
    public function getScope($srcType)
    {

        return [
            /*
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('CompleteFactories%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\RepositoryBeforeInterface', 'ColumnInterface\RepositoryAfterInterface'***REMOVED***,
                        'dependency' => ['Repository\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => 'Repository\AbstractRepository',
                        'namespace' => 'Greatest',
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'complete-factories',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependenciesFactory%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependencyOne', 'Repository\MyDependencyTwo', 'Repository\MyDependencyThree'***REMOVED***,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-dependencies-factory',
            ***REMOVED***,
            */
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependencyFactory%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependency'***REMOVED***,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-dependency-factory',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicFactory%s', $srcType),
                        'type' => $srcType,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-factory',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicAbstract%s', $srcType),
                        'type' => $srcType,
                        'abstract' => true
                    ***REMOVED***
                ),
                'basic-abstract',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependencies%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependencyOne', 'Repository\MyDependencyTwo', 'Repository\MyDependencyThree'***REMOVED***
                    ***REMOVED***
                ),
                'basic-dependencies',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependency%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependency'***REMOVED***
                    ***REMOVED***
                ),
                'basic-dependency',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicImplements%s', $srcType),
                        'type' => $srcType,
                        'implements' => [
                            '\Zend\ServiceManager\ServiceLocatorAwareInterface'

                        ***REMOVED***,
                        'dependency' => [
                            '\Zend\ServiceManager\ServiceLocatorAware'
                        ***REMOVED***
                    ***REMOVED***
                ),
                'basic-implements',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicExtends%s', $srcType),
                        'type' => $srcType,
                        'extends' => 'Repository\AbstractRepository'
                    ***REMOVED***
                ),
                'basic-extends',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => 'Basic'
                    ***REMOVED***
                ),
                'basic-namespace',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('LongNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'long-namespace',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('Basic%s', $srcType),
                        'type' => $srcType
                    ***REMOVED***
                ),
                'basic',
            ***REMOVED***,
        ***REMOVED***;


        //$location = __DIR__.'/src-scope.yml';

        //$parser = new Parser();

        //$data = $parser->parse(file_get_contents($location));

        //return $data;
    }

}

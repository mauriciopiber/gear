<?php
namespace GearTest;

use Symfony\Component\Yaml\Parser;

trait ScopeTrait
{
    public function getScopeForm($srcType)
    {
        return [
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicNamespaceExtendsFactory%s', $srcType),
                        'type' => $srcType,
                        'extends' => sprintf('%s\My%s', $srcType, $srcType),
                        'service' => 'factories',
                        'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'basic-namespace-extends-factory',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicNamespaceFactory%s', $srcType),
                        'type' => $srcType,
                        'service' => 'factories',
                        'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'basic-namespace-factory',
            ***REMOVED***,

            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicFactory%s', $srcType),
                        'type' => $srcType,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-factory',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicExtends%s', $srcType),
                        'type' => $srcType,
                        'extends' => sprintf('%s\My%s', $srcType, $srcType),
                        //'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'basic-extends',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('LongNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'long-namespace',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('Basic%s', $srcType),
                        'type' => $srcType
                    ***REMOVED***
                ),
                'basic',
            ***REMOVED***,
        ***REMOVED***;
    }

    public function getScope($srcType)
    {

        return [
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('AbstractCompleteInvokables%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\\'.$srcType.'BeforeInterface', 'ColumnInterface\\'.$srcType.'AfterInterface'***REMOVED***,
                        'dependency' => [$srcType.'\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => $srcType.'\Abstract'.$srcType,
                        'namespace' => 'Greatest',
                        'service' => 'invokables',
                        'abstract' => true
                  ***REMOVED***
                ),
                'abstract-complete-invokables',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('AbstractCompleteFactories%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\\'.$srcType.'BeforeInterface', 'ColumnInterface\\'.$srcType.'AfterInterface'***REMOVED***,
                        'dependency' => [$srcType.'\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => $srcType.'\Abstract'.$srcType,
                        'namespace' => 'Greatest',
                        'service' => 'factories',
                        'abstract' => true
                  ***REMOVED***
                ),
                'abstract-complete-factories',
            ***REMOVED***,

            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('CompleteInvokables%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\\'.$srcType.'BeforeInterface', 'ColumnInterface\\'.$srcType.'AfterInterface'***REMOVED***,
                        'dependency' => [$srcType.'\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => $srcType.'\Abstract'.$srcType,
                        'namespace' => 'Greatest',
                        'service' => 'invokables'
                    ***REMOVED***
                ),
                'complete-invokables',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('CompleteFactories%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\\'.$srcType.'BeforeInterface', 'ColumnInterface\\'.$srcType.'AfterInterface'***REMOVED***,
                        'dependency' => [$srcType.'\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => $srcType.'\Abstract'.$srcType,
                        'namespace' => 'Greatest',
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'complete-factories',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('CompleteFactories%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\\'.$srcType.'BeforeInterface', 'ColumnInterface\\'.$srcType.'AfterInterface'***REMOVED***,
                        'dependency' => [$srcType.'\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => $srcType.'\Abstract'.$srcType,
                        'namespace' => 'Greatest',
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'complete-factories',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicDependenciesFactory%s', $srcType),
                        'type' => $srcType,
                        'dependency' => [$srcType.'\MyDependencyOne', $srcType.'\MyDependencyTwo', $srcType.'\MyDependencyThree'***REMOVED***,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-dependencies-factory',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicDependencyFactory%s', $srcType),
                        'type' => $srcType,
                        'dependency' => [$srcType.'\MyDependency'***REMOVED***,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-dependency-factory',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicFactory%s', $srcType),
                        'type' => $srcType,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-factory',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicAbstractFactory%s', $srcType),
                        'type' => $srcType,
                        'abstract' => true,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-abstract-factory',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicAbstract%s', $srcType),
                        'type' => $srcType,
                        'abstract' => true
                    ***REMOVED***
                ),
                'basic-abstract',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicDependencies%s', $srcType),
                        'type' => $srcType,
                        'dependency' => [$srcType.'\MyDependencyOne', $srcType.'\MyDependencyTwo', $srcType.'\MyDependencyThree'***REMOVED***
                    ***REMOVED***
                ),
                'basic-dependencies',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicDependency%s', $srcType),
                        'type' => $srcType,
                        'dependency' => [$srcType.'\MyDependency'***REMOVED***
                    ***REMOVED***
                ),
                'basic-dependency',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicImplements%s', $srcType),
                        'type' => $srcType,
                        'implements' => [

                        ***REMOVED***,
                        'dependency' => [
                            '\Zend\ServiceManager\ServiceLocatorAware'
                        ***REMOVED***
                    ***REMOVED***
                ),
                'basic-implements',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicExtends%s', $srcType),
                        'type' => $srcType,
                        'extends' => $srcType.'\Abstract'.$srcType
                    ***REMOVED***
                ),
                'basic-extends',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('BasicNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => 'Basic'
                    ***REMOVED***
                ),
                'basic-namespace',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
                    [
                        'name' => sprintf('LongNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'long-namespace',
            ***REMOVED***,
            [
                new \Gear\Schema\Src\Src(
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

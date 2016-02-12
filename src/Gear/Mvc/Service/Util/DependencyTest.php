<?php
namespace Gear\Mvc\Service\Util;

class DependencyTest {

    public static function getTemplate($class, $var)
    {
        $templating = <<<EOS
    /**
     * @group $class
     */
    public function testSet{$class}()
    {
        \$mock = \$this->getMockBuilder('{$service}')
          ->disableOriginalConstructor()
          ->getMock();
        \${$var} = \$this->get{$class}();
        \${$var}->set{$class}(\$mock);
        \$this->assertInstanceOf('{$service}', \$mock);
        return \$this;
    }

    /**
     * @group {$class}
     */
    public function testGet{$class}()
    {
        \${$var} = \$this->get{$class}();
        \${$var} = \${$var}->get{$class}();
        \$this->assertInstanceOf('{$service}', \${$var});

    }<?php echo PHP_EOL;?>

EOS;


    }
}
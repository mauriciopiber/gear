<?php
namespace GearTest\ProjectTest;

use GearBaseTest\AbstractTestCase;


/**
 * @group Jenkins
 * @author piber
 *
 */
class UpgradeTest extends AbstractTestCase
{
    use \Gear\Project\UpgradeTrait;

    public function testExistsUpgradeClass()
    {
        $this->assertTrue(class_exists('\\Gear\\Project\\Upgrade'));
        $this->assertTrue(trait_exists('\\Gear\\Project\\UpgradeTrait'));
    }

}
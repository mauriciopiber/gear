<?php
namespace GearTest\FactoryTest;

use GearTest\AbstractGearTest;

class FileCreatorFactory extends AbstractGearTest
{

    /**
     * @group filecreator
     */
    public function testCreateService()
    {
        $configFactory = $this->getServiceLocator()->get('fileCreatorFactory');

        $this->assertInstanceOf('Gear\Creator\File', $configFactory);
    }
}

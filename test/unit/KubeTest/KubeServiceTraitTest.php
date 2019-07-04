<?php
namespace GearTest\KubeTest;

use PHPUnit\Framework\TestCase;
use Gear\Kube\KubeServiceTrait;
use Gear\Kube\KubeService;

/**
 * @group Gear
 * @group KubeService
 * @group Service
 */
class KubeServiceTraitTest extends TestCase
{
    use KubeServiceTrait;

    public function setUp() : void
    {
        $this->kubeServiceMock = $this->prophesize(KubeService::class);
    }

    public function testGetEmpty()
    {
        $kubeService = $this->getKubeService();
        $this->assertNull($kubeService);
    }

    public function testSet()
    {
        $this->setKubeService($this->kubeServiceMock->reveal());
        $kubeService = $this->getKubeService();

        $this->assertInstanceOf(
            KubeService::class,
            $kubeService
        );

        $this->assertEquals(
            $this->kubeServiceMock->reveal(),
            $kubeService
        );
    }
}

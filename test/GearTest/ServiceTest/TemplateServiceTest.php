<?php
namespace GearTest\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class TemplateServiceTest extends AbstractGearTest
{
    public function testCallService()
    {
        $service = $this->bootstrap->getServiceLocator()->get('templateService');
        $this->assertInstanceOf('Gear\Service\TemplateService', $service);
    }

    public function testRenderer()
    {
        $service = $this->bootstrap->getServiceLocator()->get('templateService');

        $renderer = new \Zend\View\Renderer\PhpRenderer();
        $service->setRenderer($renderer);

        $data = $service->getRenderer();
        $this->assertInstanceOf('Zend\View\Renderer\PhpRenderer', $data);
    }

    public function testRenderSimpleHtml()
    {
        $service = $this->bootstrap->getServiceLocator()->get('templateService');

        $renderer = new \Zend\View\Renderer\PhpRenderer();

        $resolver = new \Zend\View\Resolver\AggregateResolver();

        $map = new \Zend\View\Resolver\TemplateMapResolver(array(
            'layout'      => __DIR__ . '/../_mockfiles/layout.phtml',
        ));

        $resolver->attach($map);
        $renderer->setResolver($resolver);
        $service->setRenderer($renderer);

        $html = $service->render('layout', array('testOne' => 'vamoporra', 'testTwo' => 'vamoh4vamovamo'));

        $dom = new \Zend\Dom\Query($html);
        $results = $dom->execute('h4');
        $this->assertEquals('vamoh4vamovamo', $results->current()->nodeValue);

        $results = $dom->execute('p');
        $this->assertEquals('vamoporra', $results->current()->nodeValue);
    }
}

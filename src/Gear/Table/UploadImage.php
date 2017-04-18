<?php
namespace Gear\Table;

use Gear\Service\AbstractJsonService;

/**
 *
 * Classe pai das colunas
 *
 * Classe que serve como base para o funcionamento das colunas
 *
 *
 * @category   Table
 * @package    Gear
 * @subpackage Table
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class UploadImage extends AbstractJsonService implements \Gear\Column\ImplementsInterface
{
    const USE_ATTRIBUTE_TRAIT = 'GearImage\Service\ImageServiceTrait';

    const USE_ATTRIBUTE = 'GearImage\Service\ImageService';

    const ATTRIBUTE = 'ImageServiceTrait';

    public function getImplements($codeName)
    {
        $implements = [
            'Fixture' => [
                [
                    'class' => '\GearImage\Fixture',
                    'expand' => false
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        return $implements[$codeName***REMOVED***;
    }

    /**
    public function getFixtureUse()
    {
        return <<<EOS
use GearImage\Fixture as ImagemFixtureTrait;

EOS;
    }

    public function getFixtureAttribute()
    {

        return <<<EOS
    use ImagemFixtureTrait;

EOS;
    }
    */

    public function makeFixture($fixtures, $term = 'upload-image-table')
    {
        $fixtureSuite = '';

        foreach ($fixtures as $fixture) {
            $fixtureFix = str_replace('insert', $term, $fixture);

            $fixtureSuite .= <<<EOS
$fixtureFix
EOS;
        }
        return $fixtureSuite;
    }


    public function getControllerUnitTest($tableName)
    {

        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        $module = $this->str('class', $this->getModule()->getModuleName());

        $tableUrl = $this->str('url', $tableName);
        $table = $this->str('class', $tableName);
        $tableVar = $this->str('var', $tableName);

        return <<<EOS

    /**
     * @group controller.upload-image
     */
    public function testAccessUploadImageWithoutIdReturnToList()
    {
        \$this->url->fromRoute({$table}Controller::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn({$table}Controller::LISTS);
        \$this->url->setController(\$this->controller)->shouldBeCalled();

        \$this->routeMatch->setParam('action', 'upload-image');
        \$result = \$this->controller->dispatch(\$this->request);
        \$response = \$this->controller->getResponse();
        \$this->assertEquals(302, \$response->getStatusCode());
        \$this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', \$result);
    }

    /**
     * @group controller.upload-image
     */
    public function testAccessUploadImageWithInvalidIdReturnToList()
    {
        \$this->url->fromRoute({$table}Controller::LISTS, [***REMOVED***, [***REMOVED***, false)->willReturn({$table}Controller::LISTS);
        \$this->url->setController(\$this->controller)->shouldBeCalled();

        \$this->{$tableVar}Service->selectById(6000)->willReturn(null)->shouldBeCalled();

        \$this->routeMatch->setParam('action', 'upload-image');
        \$this->routeMatch->setParam('id', 6000);

        \$result = \$this->controller->dispatch(\$this->request);
        \$response = \$this->controller->getResponse();
        \$this->assertEquals(302, \$response->getStatusCode());
        \$this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', \$result);
    }

    /**
     * @group controller.upload-image
     */
    public function testPostUploadImageReturnPRGPlugin()
    {
        \$this->url->fromRoute({$table}Controller::IMAGE, ['id' => 31***REMOVED***)->willReturn({$table}Controller::IMAGE.'/31');
        \$this->url->setController(\$this->controller)->shouldBeCalled();

        \$this->entity = \$this->prophesize('{$module}\Entity\\{$table}');

        \$this->{$tableVar}Service->selectById(31)->willReturn(\$this->entity)->shouldBeCalled();

        \$this->routeMatch->setParam('action', 'upload-image');
        \$this->routeMatch->setParam('id', 31);
        \$this->request->setMethod('POST');
        \$result = \$this->controller->dispatch(\$this->request);
        \$response = \$this->controller->getResponse();
        \$this->assertEquals(303, \$response->getStatusCode());
        \$this->assertInstanceOf('Zend\Http\PhpEnvironment\Response', \$result);
    }

    /**
     * @group controller.upload-image
     */
    public function testPostUploadImageProcessSuccess()
    {
        \$this->url->fromRoute({$table}Controller::IMAGE, ['id' => 31***REMOVED***)->willReturn({$table}Controller::IMAGE.'/31');
        \$this->url->setController(\$this->controller)->shouldBeCalled();

        \$this->entity = \$this->prophesize('{$module}\Entity\\{$table}');

        \$this->{$tableVar}Service->selectById(31)->willReturn(\$this->entity)->shouldBeCalled();

        \$this->imageService->appendPlugin()->shouldBeCalled();
        \$this->imageService->updateImages('{$tableUrl}', 31)->willReturn(true)->shouldBeCalled();
        \$this->imageService->updatePosition([***REMOVED***)->willReturn(true)->shouldBeCalled();
        \$this->imageService->clearCache()->shouldBeCalled();

        \$prg = \$this->prophesize('Zend\Mvc\Controller\Plugin\PostRedirectGet');
        \$prg->setController(\$this->controller)->shouldBeCalled();
        \$prg->__invoke('{$moduleUrl}/{$tableUrl}/upload-image/31', true)->willReturn([***REMOVED***);

        \$this->controller->getPluginManager()->setService('postredirectget', \$prg->reveal());

        \$this->routeMatch->setParam('action', 'upload-image');
        \$this->routeMatch->setParam('id', 31);

        \$this->request->setMethod('POST');
        \$result = \$this->controller->dispatch(\$this->request);
        \$response = \$this->controller->getResponse();

        \$this->assertEquals(200, \$response->getStatusCode());
        \$this->assertInstanceOf('Zend\View\Model\ViewModel', \$result);
    }

EOS;
    }

    /**
     * USADO NAS FIXTURES
     * @param unknown $table
     * @return string
     */
    public function getFixtureLoad($table)
    {

        $module = $this->getModule()->getModuleName();
        $var = $this->str('var-lenght', $table);
        $url = $this->str('url', $table);

        return <<<EOS
            \$this->createUploadImageTableFixture(
                '$url',
                \${$var},
                \$imageEntity,
                \$userReferenced,
                new \\{$module}\Module()
            );

EOS;
    }

    public function getFixturePreLoad()
    {
        return <<<EOS
        \$imageEntity = '\\{$this->getModule()->getModuleName()}\Entity\UploadImage';

EOS;
    }

    public function getControllerViewView()
    {
        return <<<EOS
                    'images' => \$images,
EOS;
    }

    public function getControllerViewQuery($tableName)
    {

        $tableUrl = $this->str('url', $tableName);
        $tableName = $this->str('class', $tableName);

        $tableId = $this->str('var-lenght', 'id'.$tableName);

        return <<<EOS
        \$images = \$this->getImageService()->query('$tableUrl', array(), \${$tableId});

EOS;
    }

    public function getViewView($tableName)
    {
        $tableLabel = $this->str('label', $tableName);
        return <<<EOS
        <?php if (count(\$this->images) > 0) :?>
        <div class="form-group">
            <h4><?php echo \$this->translate('Images of');?> $tableLabel</h4>
            <?php foreach (\$this->images as \$image) :?>
                <a class="fancybox" rel="group" href="<?php echo sprintf(\$image->getUploadImage(), 'lg');?>">
                    <img src="<?php echo sprintf(\$image->getUploadImage(), 'pre');?>" alt="" />
                </a>
            <?php endforeach;?>
        </div>
        <?php endif;?>

EOS;
    }
}

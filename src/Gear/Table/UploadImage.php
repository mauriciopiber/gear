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
    const USE_ATTRIBUTE = 'GearImage\Service\ImageServiceTrait';

    const ATTRIBUTE = 'ImageServiceTrait';

    public function getImplements($codeName)
    {
        $implements = [
            'Fixture' => [
                'ImagemFixtureTrait' => 'GearImage\Fixture'
            ***REMOVED***
        ***REMOVED***;

        return $implements[$codeName***REMOVED***;
    }

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
        $moduleClass = $this->str('class', $this->getModule()->getModuleName());

        $tableUrl = $this->str('url', $tableName);
        $tableClass = $this->str('class', $tableName);

        return <<<EOS

    /**
     * @group UploadImage
     */
    public function testAccessUploadImageWithoutIdReturnToList()
    {
        \$this->mockUser();
        \$this->dispatch('/$moduleUrl/$tableUrl/upload-image');
        \$this->assertResponseStatusCode(302);
        \$this->assertRedirectTo('/$moduleUrl/$tableUrl/listar/page//orderBy');
        \$this->assertModuleName('$moduleClass');
        \$this->assertControllerName('$moduleClass\Controller\\{$tableClass}');
        \$this->assertActionName('upload-image');
        \$this->assertControllerClass('{$tableClass}Controller');
        \$this->assertMatchedRouteName('$moduleUrl/$tableUrl/upload-image');
    }

    /**
     * @group UploadImage
     */
    public function testAccessUploadImageWithInvalidIdReturnToList()
    {
        \$this->mockUser();
        \$this->dispatch('/$moduleUrl/$tableUrl/upload-image/6000');
        \$this->assertResponseStatusCode(302);
        \$this->assertRedirectTo('/$moduleUrl/$tableUrl/listar/page//orderBy');

        \$this->assertModuleName('$moduleClass');
        \$this->assertControllerName('$moduleClass\Controller\\{$tableClass}');
        \$this->assertActionName('upload-image');
        \$this->assertControllerClass('{$tableClass}Controller');
        \$this->assertMatchedRouteName('$moduleUrl/$tableUrl/upload-image');
    }

    /**
     * @depends testCreateSuccess
     * @group UploadImage
     */
    public function testPostUploadImageReturnPRGPlugin(\$resultSet)
    {
        \$this->mockUser();
        \$this->dispatch(
            '/$moduleUrl/$tableUrl/upload-image/'.\$resultSet->getId{$tableClass}(),
            'POST',
            array()
        );

        \$this->assertResponseStatusCode(303);
        \$this->assertRedirectTo(
            '/$moduleUrl/$tableUrl/upload-image/'.\$resultSet->getId{$tableClass}()
        );

        \$this->assertModuleName('$moduleClass');
        \$this->assertControllerName('$moduleClass\Controller\\{$tableClass}');
        \$this->assertActionName('upload-image');
        \$this->assertControllerClass('{$tableClass}Controller');
        \$this->assertMatchedRouteName('$moduleUrl/$tableUrl/upload-image');
    }

    /**
     * @depends testCreateSuccess
     * @group UploadImage
     */
    public function testPostUploadImageProcessSuccess(\$resultSet)
    {

        \$this->mockUser();
        \$this->mockPluginPostRedirectGet(array());
        \$this->dispatch(
            '/$moduleUrl/$tableUrl/upload-image/'.\$resultSet->getId{$tableClass}(),
            'POST',
            array()
        );

        \$this->assertResponseStatusCode(200);
        \$this->assertModuleName('$moduleClass');
        \$this->assertControllerName('$moduleClass\Controller\\{$tableClass}');
        \$this->assertActionName('upload-image');
        \$this->assertControllerClass('{$tableClass}Controller');
        \$this->assertMatchedRouteName('$moduleUrl/$tableUrl/upload-image');
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
        \$images = \$this->getImagemService()->query('$tableUrl', array(), \${$tableId});

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

<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;
use Gear\Column\ImplementsInterface;
use Gear\Column\Mvc\ServiceAwareInterface;

/**
 * Cria um upload file de imagens.
 *
 *
 * @category   Column
 * @package    Gear
 * @subpackage Column
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class UploadImage extends Varchar implements ServiceAwareInterface, ImplementsInterface
{
    protected $settings;

    /**
     * @param ColumnObject $column Coluna
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     *
     * @return void
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }

        $this->rand = rand(0, 999999);
        parent::__construct($column);
    }

    /**
     * @param int $iterator Número base
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getValue()
     *
     * @return string
     */
    public function getValue($iterator)
    {
        unset($iterator);
        $table = $this->str('url', $this->column->getTableName());

        $column = $this->str('var', $this->column->getName());

        return sprintf('/upload/%s-%s/pre', $table, $column).'%02d'.sprintf('%s.gif', $column);
    }

    /**
     * Cria caminho da ímagem para ser utilizada exclusivamente na verificação de upload realizado com sucesso no e2e.
     *
     * @param int $iterator Número base
     *
     * @return string
     */
    public function getFakeValue($iterator)
    {
        unset($iterator);
        $table = $this->str('url', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        return sprintf('/upload/%s-%s/prefake-image.png', $table, $column);
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature Gear\Mvc\Spec\Feature\Feature.
     *
     * @param int $default Número Base
     * @param int $line    Linhas
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu entro com uma imagem no campo "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature Gear\Mvc\Spec\Feature\Feature.
     *
     * @param int $default Número Base
     * @param int $line    Linhas
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($default = 30, $line = 1)
    {
        $value = sprintf($this->getFakeValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo a imagem "{$value}" no campo "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature Gear\Mvc\Spec\Feature\Feature.
     *
     * @param int $default Número Base
     *
     * @return string
     */
    public function getIntegrationActionView($default = 30)
    {
        $value = sprintf($this->getValue($default), 30, $this->str('var', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
    E eu vejo o atributo "{$attribute}" com a imagem "{$value}"

EOS;
        return $view;
    }


    /**
     * @deprecated Não está sendo utilizado em lugar nenhum, perderá validade se certificar que não é usado.
     *
     * @param array $settings Configuração
     *
     * @return void
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    /**
     * Cria testes unitários para as ações de Controller em Gear\Mvc\Controller\ControllerTestService.
     *
     * @param int $fixtureItem Número base
     *
     * @return string
     */
    public function getControllerUnitTest($fixtureItem)
    {
        $this->fixtureItem = explode(PHP_EOL, $fixtureItem);

        $controller = $this->str('class', $this->column->getTableName());
        $controllerUrl = $this->str('url', $this->column->getTableName());
        $module = $this->getModule()->getModuleName();
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());


        $fixtureSuite = '';

        foreach ($this->fixtureItem as $fixture) {
            $fixtureFix = str_replace('insert', 'upload-image', $fixture);

            $fixtureSuite .= <<<EOS
$fixtureFix
EOS;
        }

        return <<<EOS
    public function testCantCreateWithWrongImage()
    {
        \$newData = array(
$fixtureSuite
        );
        \$this->mockUser();
        \$this->mockPluginPostRedirectGet(\$newData);
        \$this->mockPluginFilePostRedirectGet(\$newData);
        \$this->dispatch('/{$moduleUrl}/{$controllerUrl}/criar', 'POST', \$newData);
        \$this->assertResponseStatusCode(200);

        \$this->assertModuleName('{$module}');
        \$this->assertControllerName('{$module}\Controller\\{$controller}');
        \$this->assertActionName('create');
        \$this->assertControllerClass('{$controller}Controller');
        \$this->assertMatchedRouteName('{$moduleUrl}/{$controllerUrl}/create');
    }

EOS;

    }

    /**
     * Cria comandos que são inseridos antes de mostrar a view, utilizados em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerEditBeforeView()
    {

        $class = $this->str('class', $this->column->getName());
        $var = $this->str('var-lenght', $this->column->getName());


        return <<<EOS
        \${$var} = \$this->getUploadImagePath('get{$class}');

EOS;
    }

    /**
     * Cria comandos de declaração das variáveis que serão utilizados em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerDeclareVar()
    {
        return <<<EOS
        \${$this->str('var-lenght', $this->column->getName())} = '';

EOS;

    }

    /**
     * Cria comandos de declaração das variáveis que serão enviadas para a view utilizados em
     * Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerArrayView()
    {
        $varLength = $this->str('var-lenght', $this->column->getName());
        $var = $this->str('var', $this->column->getName());

        return <<<EOS
                '{$var}' => \${$varLength},

EOS;

    }

    /**
     * Cria comando a ser executado antes de exibir a view em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerCreateBeforeView()
    {

        $varLength = $this->str('var-lenght', $this->column->getName());
        $var = $this->str('var', $this->column->getName());

        return <<<EOS
        \${$varLength} = \$this->getTempUpload('{$var}');

EOS;

    }

    /**
     * Cria comando que será executado em caso de falha na validação em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerValidationFail()
    {
        return <<<EOS
        \$this->verifyErrors('{$this->str('var', $this->column->getName())}');

EOS;
    }

    /**
     * Retorna as classes que serão usadas para criar o controller em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerUse()
    {
        return <<<EOS
use GearBase\Controller\UploadImageTrait;

EOS;
    }

    /**
     * Retorna os atributos de instancia das dependências do controller em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerAttribute()
    {
        return <<<EOS
    use UploadImageTrait;

EOS;
    }

    /**
     * Retorna o código para preparar as ímagens para serem utilizadas em fixture
     *
     * @param int $randomNumber Número base
     *
     * @return string
     */
    public function getPreFixture($randomNumber = 01)
    {
        $name = $this->str('var', $this->column->getName());
        $table = $this->str('url', $this->column->getTableName());

        return <<<EOS
        \$this->{$name} = \$I->setUploadImageFixture(
            '$table',
            '$name',
            '$randomNumber'
        );

EOS;
    }

    /**
     * @deprecated Antiga função utilizada para os testes do Codeception
     *
     * Cria o código para ser utilizado em Gear\Service\AbstractJsonService
     *
     * @param int $numberReference Número base.
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getFixture()
     *
     * @return string
     */
    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value =  $this->str('var', $this->column->getName());

        return <<<EOS
                '$name' => \$this->{$value},

EOS;
    }


    /**
     * Cria o código para ser inserido no service em Gear\Mvc\Service\ServiceService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceInsertBody()
     *
     * @return string
     */
    public function getServiceInsertBody()
    {

        $var = $this->str('var', $this->column->getName());
        $lenght = $this->str('var-lenght', $this->column->getName());
        $table = $this->str('url', $this->column->getTableName());

        return <<<EOS
        \$$lenght = \$this->getImageService()->overwriteImage(
            \$data,
            '$table',
            '$var'
        );

EOS;

    }

    /**
     * @deprecated será alterada a funcionalidade de selectOneBy do Repository, possivelmente será modificado
     *
     * @param int $number Número base
     *
     * @return string
     */
    public function selectOneBy($number)
    {
        $table = $this->str('url', $this->column->getTableName());
        $var = $this->str('var', $this->column->getName());
        $iterator = sprintf('%02d', $number);
        return <<<EOS
/upload/$table-$var/%s{$iterator}{$var}.gif
EOS;

    }

    /**
     * Cria código preparado para fixture em Gear\Mvc\Fixture\FixtureService
     *
     * @return string
     */
    public function getFixtureGetFixture()
    {
        $module = $this->getModule()->getModuleName();
        return <<<EOS
        \$module = new \\$module\Module();
        \$moduleDir = \$module->getLocation();

EOS;
    }

    /**
     * Retorna as dependências que serão utilizadas pela classe de fixture em Gear\Mvc\Fixture\FixtureService
     *
     * @return string
     */
    public function getFixtureUse()
    {
        return <<<EOS
use GearImage\Fixture as ImagemFixtureTrait;

EOS;
    }

    /**
     * Retorna os atributos das dependências utilizadas pela classe de fixture em Gear\Mvc\Fixture\FixtureService
     *
     * @return string
     */
    public function getFixtureAttribute()
    {

        return <<<EOS
    use ImagemFixtureTrait;

EOS;
    }

    /**
     * @deprecated será alterada a funcionalidade de getOrderBy do Repository, possivelmente será modificado
     *
     * @param int $iterator Número base
     *
     * @return string
     */
    public function getOrderBy($iterator)
    {
        $table = $this->str('url', $this->column->getTableName());
        $var = $this->str('var', $this->column->getName());
        $iterator = sprintf('%02d', $iterator);
        return <<<EOS
/upload/$table-$var/%s{$iterator}{$var}.gif
EOS;
    }


    /**
     * Utilizado para criar as fixtures para inserção no banco em Gear\Mvc\Fixture\FixtureService
     *
     * @param int $iterator Número base
     *
     * {@inheritDoc}
     * @see \Gear\Column\Varchar\Varchar::getFixtureData()
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        $contexto = $this->str('url', $this->column->getTableName());

        $iterator = sprintf('%02d', $iterator);

        $var = $this->str('var', $this->column->getName());
        return <<<EOS
                '$var' =>
                \$this->createUploadImageFixture(
                    '$contexto',
                    '$var',
                    '$iterator',
                    \$moduleDir
                ),

EOS;
    }

    /**
     * Utilizado para deletar as imagens no service em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceDeleteBody()
    {
        $contexto = $this->str('url', $this->column->getTableName());
        return <<<EOS
            \$this->getImageService()->deleteUploadImage(\$idTable, '$contexto');

EOS;
    }

    /**
     * Retorna a classe que deve ser implementada em cada recurso em Gear\Mvc\Fixture\FixtureService
     *
     * {@inheritDoc}
     * @see \Gear\Column\ImplementsInterface::getImplements()
     *
     * @param string $codeName Nome do Src.
     *
     * @return string
     */
    public function getImplements($codeName)
    {
        $implements = [
            'Service' => [
                'GearImage\Service\ImagemServiceTrait'
            ***REMOVED***,
            'Fixture' => [
                'ImagemFixtureTrait' => 'GearImage\Fixture'
            ***REMOVED***
        ***REMOVED***;

        return $implements[$codeName***REMOVED***;
    }

    /**
     * Retorna o servico que será usado nas classes
     *
     * @return string
     */
    public function getUse()
    {
        return <<<EOS
use GearImage\Service\ImagemServiceTrait;

EOS;
    }

   /**
     * Retorna o servico que será usado nas classes
     *
     * @return string
     */
    public function getAttribute()
    {
        return <<<EOS
    use ImagemServiceTrait;

EOS;
    }

    /**
     * Replica a chamada de ServiceInsertBody
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateBody()
     *
     * @return string
     */
    public function getServiceUpdateBody()
    {
        return $this->getServiceInsertBody();
    }

    /**
     * Cria o que manda a imagem para o GearImage processar em Gear\Mvc\Service\ServiceService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceInsertSuccess()
     *
     * @return string
     */
    public function getServiceInsertSuccess()
    {
        $var = $this->str('var', $this->column->getName());
        $contexto = $this->str('url', $this->column->getTableName());
        $lenght = $this->str('var-lenght', $this->column->getName());

        return <<<EOS
            if (isset(\$data['$var'***REMOVED***)) {
                \$this->getImageService()->createUploadImage(
                    \$$lenght,
                    '$contexto-$var',
                    \$data['$var'***REMOVED***
                );
            }

EOS;
    }

    /**
     * Gear o código que manda a imagem para GearImage em Gear\Mvc\Service\ServiceService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceUpdateSuccess()
     *
     * @return string
     */
    public function getServiceUpdateSuccess()
    {
        $lenght = $this->str('var-lenght', $this->column->getName());

        $var = $this->str('var', $this->column->getName());
        $contexto = $this->str('url', $this->column->getTableName());

        return <<<EOS
            if (isset(\$data['$var'***REMOVED***)) {
                \$this->getImageService()->updateUploadImage(
                    \$$lenght,
                    '$contexto-$var',
                    \$data['$var'***REMOVED***
                );
            }

EOS;
    }

    /**
     * Retorna os valores padrões salvos no config do próprio gear, isso pode causar certo erro, verificar.
     *
     * @return array|unknown
     */
    public function getSettings()
    {
        if (!isset($this->settings)) {
            $config = $this->getServiceLocator()->get('config');
            $this->settings = $config['fileUpload'***REMOVED***;
        }
        return $this->settings;
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     *
     * @return string
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());


        $element = <<<EOS
        \${$var} = new Element\File('$elementName');
        \${$var}->setLabel('$label');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'file',
            'class' => 'form-control'
        ));
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Retorna a exibição do form nos viewhelpers utilizado em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getViewFormElement()
     *
     * @return string
     */
    public function getViewFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        <div class="form-group">
            <?php echo \$this->formLabel(\$form->get('$elementName')); ?>
            <?php echo \$this->formFile(\$form->get('$elementName')); ?>
            <?php echo \$this->formElementErrors(\$form->get('$elementName')); ?>
        </div>
        <div class="form-group">
            <?php if (\$this->$elementName) : ?>
                <img src="<?php echo \$this->$elementName;?>"/>
            <?php endif;?>
        </div>

EOS;
        return $element;
    }

    /**
     * Retorna o filtro do form para Gear\Mvc\Filter\FilterService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getFilterFormElement()
     *
     * @return string
     */
    public function getFilterFormElement()
    {

        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        // File Input
        \$fileInput = new \Zend\InputFilter\FileInput('$elementName');
        \$fileInput->setRequired(false);
        \$fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    =>
                \GearBase\Module::getProjectFolder().'/public/_temp/{$elementName}tempimg.png',
                'randomize' => true,
            )
        );
        \$this->add(\$fileInput);

EOS;
        return $element;
    }

    /**
     * Função default que será chamado em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     * caso não esteja declarada a função nas classes filhas.
     *
     * @return String View Partial
     */
    public function getViewData()
    {
        $label = $this->str('label', $this->column->getName());

        $elementName =  $this->str('var', $this->column->getName());

        $element = <<<EOS
        <tr>
            <td><?php echo \$this->translate('$label');?></td>
            <td>
                <?php if (\$this->$elementName !== null) : ?>
                    <img src="<?php echo str_replace('/public', '', sprintf(\$this->$elementName, 'pre'));?>">
                <?php endif; ?>
            </td>
        </tr>

EOS;
        return $element;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     *
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $columnName = $this->str('var', $this->column->getName());


        $insert = <<<EOS
                    '$columnName' => array(
                        'error' => 0,
                        'name' => '{$columnName}{$this->rand}insert.gif',
                        'tmp_name' => \$this->mockUploadImage(),
                        'type'      =>  'image/gif',
                        'size'      =>  42,
                    ),

EOS;
        return $insert;
    }

    /**
     * Usado nos testes unitários
     *
     * {@inheritDoc}
     * @see \Gear\Column\Varchar\Varchar::getInsertAssertByColumn()
     *
     * @return string
     */
    public function getInsertAssertByColumn()
    {
        $className = $this->str('class', $this->column->getName());
        $fullpath = $this->getStaticPath('insert');

        $insert = <<<EOS
        \$this->assertEquals(
            $fullpath,
            \$resultSet->get$className()
        );

EOS;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     *
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $columnName = $this->str('var', $this->column->getName());

        $fullpath = $this->getStaticPath('insert');

        $insert = <<<EOS
            '$columnName' =>
                $fullpath,

EOS;
        return $insert;
    }

    /**
     * Retorna o nome relativo ao arquivo que será estocado como imagem nos testes.
     *
     * @param string $testName Nome do Teste.
     *
     * @return string
     */
    public function getFileName($testName)
    {
        return $this->str('var', $this->column->getName()).$this->rand.$testName.'.gif';
    }

    /**
     * Cria o nome relativo à pasta onde será estocada a imagem nos testes.
     *
     * @return string
     */
    private function sizeName()
    {
        $tableName = $this->str('class', $this->getColumn()->getTableName());
        $element =  $this->str('class', $this->column->getName());
        return $this->str('url', $tableName).'-'.$this->str('var', $element);
    }

    /**
     * Retorna a pasta onde as imagens serão salvas nos testes unitários em Controller, Service e Repository
     *
     * @return string
     */
    public function getUploadDir()
    {
        $settings = $this->getSettings();
        $path = $this->sizeName();


        $fullpath = '/public'.$settings['refDir'***REMOVED***.'/'.$path;

        return $fullpath;
    }

    /**
     * @deprecated Não foram encontrados registros do método ser utilizado
     *
     * @param string $testName Nome do arquivo
     *
     * @return string
     */
    public function getFullPath($testName)
    {
        $settings = $this->getSettings();
        $path = $this->sizeName();
        $elementName = $this->getFileName($testName);

        $fullpath = '/public'.$settings['refDir'***REMOVED***.'/'.$path.'/%s'.$elementName;

        return $fullpath;
    }

    /**
     * Utilizado para definir a variável estática que guarda a imagem nos testes unitários
     *
     * @param string $testName Nome do arquivo
     *
     * @return string
     */
    private function getStaticPath($testName)
    {
        //$settings = $this->getSettings();
        //$path = $this->sizeName();
        $elementName = $this->getFileName($testName);

        $fullpath = 'static::$'.$this->str('var-lenght', $this->column->getName()).'.\'/%s'.$elementName.'\'';

        return $fullpath;
    }

    /**
     * Utilizado para criar o insert em Gear\Column\ColumnService para ser utilizado em Repository, Service e Controller.
     *
     * @return string
     */
    public function getInsertDataRepositoryTest()
    {
        $elementBasic = $this->str('var', $this->column->getName());
        $fullpath = $this->getStaticPath('insert');


        $insert = <<<EOF
            '$elementBasic' =>
                $fullpath,

EOF;

        return $insert;
    }

    /**
     * Utilizado para criar o assert em Gear\Column\ColumnService para ser utilizado em Repository, Service e Controller.
     *
     * @return string
     */
    public function getInsertAssertRepositoryTest()
    {
        $className = $this->str('class', $this->column->getName());
        $fullpath = $this->getStaticPath('insert');

        $insert = <<<EOF
        \$this->assertEquals(
            $fullpath,
            \$resultSet->get{$className}()
        );

EOF;
        return $insert;
    }

    /**
     * @deprecated Não foram encontrado registros do código estar sendo utilizado
     *
     * @return string
     */
    public function getUpdateDataRepositoryTest()
    {
        $elementBasic = $this->str('var', $this->column->getName());
        $fullpath = $this->getStaticPath('update');


        $insert = <<<EOF
            '$elementBasic' =>
            $fullpath,

EOF;

        return $insert;
    }

    /**
     * @deprecated Não foram encontrado os registros de onde o código está sendo utilizado
     *
     * @return string
     */
    public function getUpdateAssertRepositoryTest()
    {
        $className = $this->str('class', $this->column->getName());
        $fullpath = $this->getStaticPath('update');

        $insert = <<<EOF
        \$this->assertEquals(
            $fullpath,
            \$resultSet->get{$className}()
        );

EOF;
        return $insert;
    }


    /**
     * @deprecated Não foram encontrados onde a coluna está sendo utilizada.
     *
     * @return string
     */
    public function getInsertFileExistsTest()
    {

        $varLenght = $this->str('var-lenght', $this->column->getName());

        $insert = <<<EOS

        \$baseDirUpload = \GearBase\Module::getProjectFolder().static::\${$varLenght};
        \$this->assertFileExists(\$baseDirUpload.'/pre{$this->getFileName('insert')}');
        \$this->assertFileExists(\$baseDirUpload.'/sm{$this->getFileName('insert')}');
        \$this->assertFileExists(\$baseDirUpload.'/xs{$this->getFileName('insert')}');

EOS;
        return $insert;
    }

    /**
     * @deprecated Não foi encontrado os registros de onde a coluna está sendo utilizada
     *
     * @return string
     */
    public function getUpdateFileExistsTest()
    {
        $varLenght = $this->str('var-lenght', $this->column->getName());

        $update = <<<EOS
        \$baseDirUpload = \GearBase\Module::getProjectFolder().static::\${$varLenght};
        \$this->assertFileExists(\$baseDirUpload.'/pre{$this->getFileName('update')}');
        \$this->assertFileExists(\$baseDirUpload.'/sm{$this->getFileName('update')}');
        \$this->assertFileExists(\$baseDirUpload.'/xs{$this->getFileName('update')}');

EOS;
        return $update;
    }
}

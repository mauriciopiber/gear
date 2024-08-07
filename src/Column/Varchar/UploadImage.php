<?php
namespace Gear\Column\Varchar;

use Gear\Column\Varchar\Varchar;

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
class UploadImage extends Varchar
{
    protected $settings;

    public static $mvcFeatureNullTemplate = 'E eu vejo a imagem vazia no campo "%s"';

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

    public function getSetUp()
    {
    }

    /**
     *
     * {@inheritDoc}
     * @see \Gear\Mvc\Service\ColumnInterface\ServiceSetUpInterface::getServiceSetUp()
     */
    public function getServiceSetUp()
    {
        $table = $this->str('class', $this->column->getTableName());

        return <<<EOS

        \$this->imageService = \$this->prophesize('GearImage\Service\ImageService');
        \$this->service->setImageService(\$this->imageService->reveal());

EOS;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Gear\Mvc\Service\ColumnInterface\ServiceFixtureDataInterface::getServiceFixtureData()
     */
    public function getServiceFixtureData()
    {
        $columnName = $this->str('var', $this->column->getName());

        return <<<EOS
            '{$columnName}' => 'image123',

EOS;
    }

    /**
     *
     * Cria a configuração do Form para Upload de Image nos Controllers.
     */
    public function getControllerSetUp()
    {
        return <<<EOS
        \$this->imageService = \$this->prophesize('GearImage\Service\ImageService');
        \$this->controller->setImageService(\$this->imageService->reveal());

EOS;
    }


    /**
     * @TODO FIX 1
     * Gera o Mock necessário para testar o método create do service adicionado na v1.0.0.
     */
    public function getServiceCreateMock()
    {
        $table = $this->str('var', $this->column->getTableName());
        $tableUrl = $this->str('url', $this->column->getTableName());
        $tableClass = $this->str('class', $this->column->getTableName());
        $columnUrl = $this->str('url', $this->column->getName());
        $columnVar = $this->str('var', $this->column->getName());

        $overwrite = strtolower($table.$columnVar);

        return <<<EOS
        \$this->imageService->replaceDataForm(
            \$data,
            '{$tableUrl}',
            {$tableClass}Service::IMAGES
        )->willReturn([***REMOVED***)->shouldBeCalled();

        \$this->imageService->saveImageColumns(
            [***REMOVED***,
            '{$tableUrl}'
        )->shouldBeCalled();

EOS;
    }

    /**
     * Gera o Mock necessário para testar o método update do service adicionado na v1.0.0.
     */
    public function getServiceUpdateMock()
    {
        return $this->getServiceCreateMock();
    }

    /**
     * Usado em Mvc/Filter
     *
     * Cria código pra preparar o filtro para passar com sucesso.
     * Nesse caso, é necessário desativar a verificação padrão do Zend para Upload de Arquivos.
     */
    public function getFilterValidPost()
    {
        $ndnt = str_repeat(' ', 4*2);

        $name = $this->str('var', $this->column->getName());

        return $ndnt.sprintf('$inputFilter->get(\'%s\')->setAutoPrependUploadValidator(false);', $name).PHP_EOL;
    }

    /**
     * Used on Mvc/Spec/Step
     *
     * @param int $iterator Número base
     *
     * @return string
     */
    public function getValueDatabase($iterator)
    {
        $table = $this->str('url', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        return sprintf('upload/%s-%s/%02d-%s-%s-%s.gif', $table, $column, $iterator, '%s', $table, $column);
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
        $table = $this->str('url', $this->column->getTableName());
        $column = $this->str('var', $this->column->getName());
        return sprintf('/upload/%s-%s/%02d-pre-%s-%s.gif', $table, $column, $iterator, $table, $column);
    }

    /**
     * Used on Mvc\Spec\Feature
     *
     * Cria caminho da ímagem para ser utilizada exclusivamente
     * na verificação de upload realizado com sucesso no e2e.
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
        return sprintf('/upload/%s-%s/pre-fake-image.png', $table, $column);
    }

    /**
     * Used on Mvc\Spec\Feature
     *
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
     * Used on Mvc\Spec\Feature
     *
     * Cria código para verificação da exibição da coluna em spec feature Gear\Mvc\Spec\Feature\Feature.
     *
     * @param int $default Número Base
     * @param int $line    Linhas
     * @param int $real    Se deve utilizar o método original ou o fake até a implementação oficial.
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($data)
    {
        $default = isset($data['default'***REMOVED***) ? $data['default'***REMOVED*** : 30;
        $line = isset($data['line'***REMOVED***) ? $data['line'***REMOVED*** : 1;
        $real = isset($data['real'***REMOVED***) ? $data['real'***REMOVED*** : false;

        if ($real) {
            $getValue = $this->getValue($default);
        } else {
            $getValue = $this->getFakeValue($default);
        }

        $value = sprintf($getValue, $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo a imagem "{$value}" no campo "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Used on Mvc\Spec\Feature
     *
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
     * Cria comandos que são inseridos antes de mostrar a view, utilizados em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerEditBeforeView()
    {

        $class = $this->str('class', $this->column->getTableName());

        return <<<EOS
        \$images = \$this->getImageService()->getImagePaths(\$this->data, {$class}Service::IMAGES);

EOS;
    }

    /**
     * @TODO FIX 4
     *
     * Cria comandos de declaração das variáveis que serão utilizados em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerDeclareVar()
    {
        return <<<EOS
        \${$this->str('var-length', $this->column->getName())} = '';

EOS;
    }

    /**
     *
     * Cria comandos de declaração das variáveis que serão enviadas para a view utilizados em
     * Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerCreateView()
    {
        $varLength = $this->str('var-length', $this->column->getName());
        $var = $this->str('var', $this->column->getName());

        return <<<EOS
                'images' => \$images,

EOS;
    }

    /**
     * Cria comando que será executado em caso de falha na validação em Gear\Mvc\Controller\ControllerService
     *
     * @return string
     */
    public function getControllerCreateAfter()
    {
        $className = $this->str('class', $this->column->getTableName());

        return <<<EOS
        \$images = \$this->getImageService()->getTempImagePaths(
            \$this->form,
            {$className}Service::IMAGES
        );

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
    public function getServiceCreateBefore()
    {

        $var = $this->str('var', $this->column->getName());
        $lenght = $this->str('var-length', $this->column->getName());
        $table = $this->str('url', $this->column->getTableName());

        return <<<EOS
        \$images = \$this->getImageService()->replaceDataForm(
            \$data,
            '{$table}',
            self::IMAGES
        );

EOS;
    }

    /**
     * Cria código preparado para fixture em Gear\Mvc\Fixture\FixtureService
     *
     * @return string
     */
    public function getFixtureTop()
    {
        $module = $this->getModule()->getModuleName();
        return <<<EOS
        \$moduleDir = new \\$module\Module();

EOS;
    }

    /**
     * Gera os valores que são usados no Filter do Constructor Db.
     *
     * @param int $iterator Número Base
     *
     * @return string
     */
    public function getFilterData($iterator = 99)
    {
        $ndnt = str_repeat(' ', 4*3);

        $columnName = $this->str('var', $this->column->getName());
        $template = <<<EOS
'$columnName' => array(
    'error' => 0,
    'name' => '{$columnName}{$iterator}insert.gif',
    'tmp_name' => \$this->mockUploadImage(),
    'type'      =>  'image/gif',
    'size'      =>  42,
),
EOS;

        return $this->formatLines($ndnt, $template).PHP_EOL;
    }

    /**
     * Gera o código auxiliar para as funções de Filter
     *
     * @return string
     */

    public function getFilterFunction()
    {
        $module = $this->str('class', $this->getModule()->getModuleName());

        $template = <<<EOS
    public function mockUploadImage()
    {
        \$maker = new \GearBaseTest\UploadImageMock();
        return \$maker->mockUploadFile(\\$module\Module::getLocation());
    }

EOS;

        return $template;
    }



    public function formatLines($indent, $lines)
    {
        $arr = explode("\n", $lines);

        foreach ($arr as $key => $value) {
            $arr[$key***REMOVED*** = $indent . $arr[$key***REMOVED***;
        }
        return implode("\n", $arr);
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

        $module = $this->str('class', $this->getModule()->getModuleName());

        $location = sprintf('(new \%s\Module())->getLocation()', $module);

        $iterator = sprintf('%02d', $iterator);

        //{$location}
        $var = $this->str('var', $this->column->getName());
        return <<<EOS
                '$var' => \$this->createUploadImageColumnFixture(
                    \$moduleDir,
                    '$contexto-$var',
                    '$iterator'
                ),

EOS;
    }

    /**
     * Utilizado para deletar as imagens no service em Gear\Mvc\Service\ServiceService
     *
     * @return string
     */
    public function getServiceDelete()
    {
        $contexto = $this->str('url', $this->column->getTableName());
        return <<<EOS
            \$this->getImageService()->deleteImagesTableColumn(
                \$entity,
                self::IMAGES,
                '$contexto'
            );

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
    public function getServiceUpdateBefore()
    {
        return $this->getServiceCreateBefore();
    }

    /**
     * Cria o que manda a imagem para o GearImage processar em Gear\Mvc\Service\ServiceService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\ServiceAwareInterface::getServiceInsertSuccess()
     *
     * @return string
     */
    public function getServiceCreateAfter()
    {
        $var = $this->str('var', $this->column->getName());
        $contexto = $this->str('url', $this->column->getTableName());
        $lenght = $this->str('var-length', $this->column->getName());

        return <<<EOS
            \$this->getImageService()->saveImageColumns(
                \$images,
                '{$contexto}'
            );

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
    public function getServiceUpdateAfter()
    {
        return $this->getServiceCreateAfter();
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
            <?php if (isset(\$this->images['$elementName'***REMOVED***))  : ?>
                <img src="/<?php echo \$this->images['$elementName'***REMOVED***;?>"/>
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
                    <img src="/<?php echo sprintf(\$this->$elementName, 'pre');?>">
                <?php endif; ?>
            </td>
        </tr>

EOS;
        return $element;
    }

    /**
     * Gera os valores utilizados nos testes unitários, para enviar requisições.
     *
     * @param unknown $iterator
     * @return string
     */
    public function getInputData($iterator)
    {
        $columnName = $this->str('var', $this->column->getName());


        $insert = <<<EOS
            '$columnName' => array(
                'error' => 0,
                'name' => '{$columnName}{$iterator}insert.gif',
                'tmp_name' => \$this->mockUploadImage(),
                'type'      =>  'image/gif',
                'size'      =>  42,
            ),

EOS;
        return $insert;
    }
}

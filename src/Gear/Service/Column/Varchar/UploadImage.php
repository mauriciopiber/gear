<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class UploadImage extends Varchar implements \Gear\Service\Column\ServiceAwareInterface
{
    protected $settings;



    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function getControllerEditBeforeView()
    {
        $module = $this->getModule()->getModuleName();

        $data = $this->str('class', $this->column->getTableName());


        $class = $this->str('class', $this->column->getName());
        $var = $this->str('var-lenght', $this->column->getName());


        return <<<EOS
        \${$var} = \$this->getUploadImagePath('get{$class}');

EOS;
    }

    public function getControllerDeclareVar()
    {
        return <<<EOS
        \${$this->str('var-lenght', $this->column->getName())} = '';

EOS;

    }

    public function getControllerArrayView()
    {
        return <<<EOS
                '{$this->str('var', $this->column->getName())}' => \${$this->str('var-lenght', $this->column->getName())},

EOS;

    }

    public function getControllerCreateBeforeView()
    {
        return <<<EOS
        \${$this->str('var-lenght', $this->column->getName())} = \$this->getTempUpload('{$this->str('var', $this->column->getName())}');

EOS;

    }

    public function getControllerValidationFail()
    {
        return <<<EOS
                \$this->verifyErrors('{$this->str('var', $this->column->getName())}');

EOS;
    }

    public function getControllerUse()
    {
        return <<<EOS
use GearBase\Controller\UploadImageTrait;

EOS;
    }

    public function getControllerAttribute()
    {
        return <<<EOS
    use UploadImageTrait;

EOS;
    }

    public function getPreFixture()
    {
        $name = $this->str('var', $this->column->getName());
        $table = $this->str('url', $this->column->getTableName());

        return <<<EOS
        \$this->{$name} = \$I->setUploadImageFixture('$table', '$name', '01');

EOS;
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value =  $this->str('var', $this->column->getName());

        return <<<EOS
                '$name' => \$this->{$value},

EOS;
    }

    public function getFunctionalTestSeeValue($numberReference, $position)
    {
        $value =  $this->str('var', $this->column->getName());

        $module = $this->getModule()->getModuleName();
        $table = $this->str('class', $this->column->getTableName());

        return <<<EOS
        \$I->seeElement(
            '//img[@src="'.sprintf(\$this->{$value}, 'pre').'"***REMOVED***'
        );

EOS;
    }

    public function getAcceptanceTestSeeValue($numberReference)
    {
         $value =  $this->str('var', $this->column->getName());

        return <<<EOS
        \$I->seeElement('//img[@src="'.sprintf(\$this->{$value}, 'pre').'"***REMOVED***');

EOS;
    }


    public function getServiceInsertBody()
    {

        $var = $this->str('var', $this->column->getName());
        $lenght = $this->str('var-lenght', $this->column->getName());

        return <<<EOS
        \$$lenght = \$this->overwriteImage(\$data, '$var');

EOS;

    }

    public function selectOneBy($number)
    {
        $table = $this->str('url', $this->column->getTableName());
        $var = $this->str('var', $this->column->getName());
        $iterator = sprintf('%02d', $number);
        return <<<EOS
/upload/$table-$var/%s{$iterator}{$var}.gif
EOS;

    }

    public function getFixtureGetFixture()
    {
        $module = $this->getModule()->getModuleName();
        return <<<EOS
        \$module = new \\$module\Module();
        \$moduleDir = \$module->getLocation();

EOS;
    }

    public function getFixtureUse()
    {
        return <<<EOS
use ImagemUpload\Fixture as ImagemFixtureTrait;

EOS;
    }

    public function getFixtureAttribute()
    {

        return <<<EOS
    use ImagemFixtureTrait;

EOS;
    }

    public function getOrderBy($iterator)
    {
        $table = $this->str('url', $this->column->getTableName());
        $var = $this->str('var', $this->column->getName());
        $iterator = sprintf('%02d', $iterator);
        return <<<EOS
/upload/$table-$var/%s{$iterator}{$var}.gif
EOS;
    }


    public function getFixtureData($iterator)
    {
        $contexto = $this->str('url', $this->column->getTableName());

        $iterator = sprintf('%02d', $iterator);

        $var = $this->str('var', $this->column->getName());
        return <<<EOS
                '$var' =>
                    \$this->createUploadImageFixture('$contexto', '$var', '$iterator', \$moduleDir),

EOS;
    }

    public function getServiceFunctions()
    {
        $contexto = $this->str('url', $this->column->getTableName());
        return <<<EOS
    public function overwriteImage(&\$data, \$key)
    {
        if (\$data[\$key***REMOVED*** !== null) {
            \$fileArray = \$data[\$key***REMOVED***;
            \$data[\$key***REMOVED*** = \$this->getImageService()->defineLocation(\$data[\$key***REMOVED***, '$contexto-'.\$key);
            return \$fileArray;
        } else {
            unset(\$data[\$key***REMOVED***);
        }
    }

EOS;
    }

    public function getServiceDeleteBody()
    {
        $contexto = $this->str('url', $this->column->getTableName());
        return <<<EOS
            \$this->getImageService()->deleteUploadImage(\$idTable, '$contexto');

EOS;
    }

    public function getUse()
    {
        return <<<EOS
use ImagemUpload\Service\ImagemServiceTrait;

EOS;
    }

    public function getAttribute()
    {
        return <<<EOS
    use ImagemServiceTrait;

EOS;
    }


    public function getServiceUpdateBody()
    {
        return $this->getServiceInsertBody();
    }

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

    public function getSettings()
    {
        if (!isset($this->settings)) {
            $config = $this->getServiceLocator()->get('config');
            $this->settings = $config['fileUpload'***REMOVED***;

        }
        return $this->settings;
    }

    public function __construct($column)
    {
        if ($column->getDataType() !== 'varchar') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }

        $this->rand = rand(0, 999999);
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());;


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
                <img src="<?php echo \$this->$elementName;?>" height="100" width="100"/>
            <?php endif;?>
        </div>

EOS;
        return $element;
    }

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
                \GearBase\Module::getProjectFolder().'/public/tmpImage/{$elementName}tempimg.png',
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
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
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

    public function getUpdateArrayByColumn()
    {
        $columnName = $this->str('var', $this->column->getName());


        $insert = <<<EOS
            '$columnName' => array(
                'error' => 0,
                'name' => '{$columnName}{$this->rand}update.gif',
                'tmp_name' => \$this->mockUploadImage(),
                'type'      =>  'image/gif',
                'size'      =>  42,
            ),

EOS;
        return $insert;
    }

    public function getUpdateAssertByColumn()
    {
        $className = $this->str('class', $this->column->getName());
        $columnName = $this->str('var', $this->column->getName());


        $fullpath = $this->getFullPath('update');

        $insert = <<<EOS
        \$this->assertEquals(
            '$fullpath',
            \$resultSet->get$className()
        );

EOS;

        return $insert;
    }

    public function getInsertAssertByColumn()
    {
        $className = $this->str('class', $this->column->getName());
        $columnName = $this->str('var', $this->column->getName());


        $fullpath = $this->getFullPath('insert');

        $insert = <<<EOS
        \$this->assertEquals(
            '$fullpath',
            \$resultSet->get$className()
        );

EOS;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $className = $this->str('class', $this->column->getName());
        $columnName = $this->str('var', $this->column->getName());


        $fullpath = $this->getFullPath('insert');

        $insert = <<<EOS
            '$columnName' =>
                '$fullpath',

EOS;
        return $insert;
    }




    public function getFileName($testName)
    {
        return $this->str('var', $this->column->getName()).$this->rand.$testName.'.gif';
    }

    public function sizeName()
    {
        $tableName = $this->str('class', $this->getColumn()->getTableName());
        $element =  $this->str('class', $this->column->getName());
        return $this->str('url', $tableName).'-'.$this->str('var', $element);
    }

    public function getFullPath($testName)
    {
        $settings = $this->getSettings();
        $path = $this->sizeName();
        $elementName = $this->getFileName($testName);

        $fullpath = '/public'.$settings['refDir'***REMOVED***.'/'.$path.'/%s'.$elementName;

        return $fullpath;
    }

    public function getInsertDataRepositoryTest()
    {
        $elementBasic = $this->str('var', $this->column->getName());
        $fullpath = $this->getFullPath('insert');


        $insert = <<<EOF
            '$elementBasic' =>
                '$fullpath',

EOF;

        return $insert;
    }

    public function getInsertAssertRepositoryTest()
    {
        $className = $this->str('class', $this->column->getName());
        $fullpath = $this->getFullPath('insert');

        $insert = <<<EOF
        \$this->assertEquals(
            '$fullpath',
            \$resultSet->get{$className}()
        );

EOF;
        return $insert;
    }

    public function getUpdateDataRepositoryTest()
    {
        $elementBasic = $this->str('var', $this->column->getName());
        $fullpath = $this->getFullPath('update');


        $insert = <<<EOF
            '$elementBasic' =>
            '$fullpath',

EOF;

        return $insert;
    }

    public function getUpdateAssertRepositoryTest()
    {
        $className = $this->str('class', $this->column->getName());
        $fullpath = $this->getFullPath('update');

        $insert = <<<EOF
        \$this->assertEquals(
            '$fullpath',
            \$resultSet->get{$className}()
        );

EOF;
        return $insert;
    }


    public function getInsertFileExistsTest()
    {
        $insert = <<<EOS

        \$baseDirUpload = \GearBase\Module::getProjectFolder().'/public/upload/{$this->sizeName()}';
        \$this->assertFileExists(\$baseDirUpload.'/pre{$this->getFileName('insert')}');
        \$this->assertFileExists(\$baseDirUpload.'/sm{$this->getFileName('insert')}');
        \$this->assertFileExists(\$baseDirUpload.'/xs{$this->getFileName('insert')}');

EOS;
        return $insert;
    }


    public function getUpdateFileExistsTest()
    {

        $update = <<<EOS
        \$baseDirUpload = \GearBase\Module::getProjectFolder().'/public/upload/{$this->sizeName()}';
        \$this->assertFileExists(\$baseDirUpload.'/pre{$this->getFileName('update')}');
        \$this->assertFileExists(\$baseDirUpload.'/sm{$this->getFileName('update')}');
        \$this->assertFileExists(\$baseDirUpload.'/xs{$this->getFileName('update')}');

EOS;
        return $update;
    }

  /*   public function getInsertDataTest()
    {

    }

    public function getInsertAssertTest()
    {

    }


    public function getInsertSelectTest()
    {

    }

    public function getUpdateDataTest()
    {

    }

    public function getUpdateAssertTest()
    {

    }
 */

}

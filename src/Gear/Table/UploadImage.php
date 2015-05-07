<?php
namespace Gear\Table;

use Gear\Service\AbstractJsonService;

class UploadImage extends AbstractJsonService {


    public function getFunctionalUploadImageTest($tableName)
    {
        $tableClass = $this->str('class', $tableName);
        return <<<EOS
    public function verifyShowImages(FunctionalTester \$I)
    {
        \$I->amOnPage({$tableClass}UploadImagePage::\$URL.'/'.\$this->fixture);
        \$I->seeNumberOfElements('.template-download', 3);
    }

EOS;
    }

    public function getFunctionalViewTest($tableName)
    {
        $tableClass = $this->str('class', $tableName);
        return <<<EOS

    public function verifyImages(FunctionalTester \$I)
    {
        \$I->amOnPage({$tableClass}ViewPage::\$URL.'/'.\$this->fixture);
        foreach (\$this->uploadImageFiles as \$image) {
            \$I->seeElement(
                '//img[@src="'.sprintf(\$image, 'pre').'"***REMOVED***'
            );
        }
    }

EOS;
    }

    public function getAcceptanceViewTest($tableName)
    {
        $tableClass = $this->str('class', $tableName);
        return <<<EOS

    public function verifyImages(AcceptanceTester \$I)
    {
        \$I->amOnPage({$tableClass}ViewPage::\$URL.'/'.\$this->fixture);
        foreach (\$this->uploadImageFiles as \$image) {
            \$I->seeElement(
                '//img[@src="'.sprintf(\$image, 'pre').'"***REMOVED***'
            );
        }
    }

EOS;
    }

    public function getPosFixture($tableName)
    {
        $tableUrl = $this->str('url', $tableName);
        $tableClass = $this->str('class', $tableName);
        $module = $this->getModule()->getModuleName();


        return <<<EOS

        \$this->uploadImageFiles = \$I->setUploadImageTableFixture(
            '$tableUrl',
            '{$module}\Entity\\{$tableClass}',
            \$this->fixture,
            '{$module}\Entity\UploadImage'
        );

EOS;
    }

    public function getFixtureLoad($table)
    {

        $var = $this->str('var', $table);
        $class = $this->str('class', $table);
        $url = $this->str('url', $table);

        return <<<EOS
            \$this->createUploadImageTableFixture('$url', \${$var}, \$imageEntity, \$userReferenced);

EOS;
    }

    public function getFixturePreLoad()
    {
        return <<<EOS
        \$imageEntity = '\\{$this->getModule()->getModuleName()}\Entity\UploadImage';

EOS;
    }

    public function getControllerViewView($tableName)
    {
        return <<<EOS
                    'images' => \$images,
EOS;
    }

    public function getControllerViewQuery($tableName)
    {

        $tableUrl = $this->str('url', $tableName);
        $tableName = $this->str('class', $tableName);

        return <<<EOS
        \$images = \$this->getImagemService()->query('$tableUrl', array(), \$id{$tableName});

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

<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class UploadImageManager extends AbstractJsonService implements ModuleManagerInterface
{
    public function module(array $controllers)
    {
        $this->getFileCreator()->createFile(
            'template/module/config/empty-upload-image.phtml',
            array(),
            'upload-image.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function mergeUploadImageConfigAssociationFromDb(\GearJson\Db\Db $db)
    {
        $this->db = $db;
        $this->mergeUploadImageConfigAssociation();
    }

    public function mergeUploadImageConfigAssociation()
    {
        $tableName = $this->db->getTable();
        $this->tableName = $this->db->getTable();
        $this->tableNameUrl = $this->str('url', $tableName);
        //carrega arquivo criado anteriormente.

        $uploadImageConfig = include $this->getModule()->getConfigExtFolder().'/upload-image.config.php';

        $sizeAggregate = array();
        $size = '';

        if (!empty($uploadImageConfig)) {
            $sizeAggregate = $uploadImageConfig['size'***REMOVED***;
            $size .= $this->convertArrayBackToString($sizeAggregate, true);
        }


        $size .= $this->generateEmptyUploadImageLine($this->tableNameUrl);
        return $this->createUploadImageConfig($size);
    }

    public function mergeUploadImageColumnFromDb(\GearJson\Db\Db $db)
    {
        $this->db = $db;
        $this->mergeUploadImageColumn();
    }

    public function mergeUploadImageColumn()
    {
        $tableName = $this->db->getTable();
        $this->tableName = $this->db->getTable();
        $this->tableNameUrl = $this->str('url', $tableName);
        //carrega arquivo criado anteriormente.

        $uploadImageConfig = include $this->getModule()->getConfigExtFolder().'/upload-image.config.php';

        $sizeAggregate = array();
        $size = '';

        if (!empty($uploadImageConfig)) {
            $sizeAggregate = $uploadImageConfig['size'***REMOVED***;
            $size .= $this->convertArrayBackToString($sizeAggregate, false);
        }


        $uploadImageColumns = $this->getColumnService()->getSpecifiedColumns(
            $this->db,
            'Gear\Column\Varchar\UploadImage'
        );

        if (!empty($uploadImageColumns) > 0) {
            foreach ($uploadImageColumns as $column) {
                //seta nome que será utilizado nas configurações
                $sizeName = $this->tableNameUrl.'-'.$this->str('var', $column->getColumn()->getName());
                if (!array_key_exists($sizeName, $sizeAggregate)) {
                    $size .= $this->generateUploadImageSpecialityLine(
                        $this->tableNameUrl.'-'.$this->str('var', $column->getColumn()->getName())
                    );
                }

                $dir = $this->getModule()->getPublicUploadFolder().'/'.$sizeName;

                if (!is_dir($dir)) {
                    $this->getModule()->getDirService()->mkDir($dir);
                }
                $this->getModule()->writable($dir);
            }
        }

        return $this->createUploadImageConfig($size);
    }


    public function convertArrayBackToString($sizeAggregate)
    {
        $size = '';
        if (is_array($sizeAggregate) && count($sizeAggregate)>0) {
            foreach ($sizeAggregate as $i => $sizes) {
                $size .= $this->convertUploadImageArrayToString($i, $sizes);
            }
        }

        return $size;
    }


    /**
     * Nome da entidade usada no arquivo upload-image.config.php
     * @return string
     */
    public function getEntityName()
    {
        $entity    = sprintf('%s\\Entity\UploadImage', $this->getModule()->getModuleName());
        return $entity;
    }

    /**
     * Pasta de upload usada no arquivo upload-image.config.php
     * @return string
     */
    public function getUploadDir()
    {
        $uploadDir = '/../../public/upload/';
        return $uploadDir;
    }

    /**
     * Pasta de referencia para imagens usada no arquivo upload-image.config.php
     * @return string
     */
    public function getRefDir()
    {
        $refDir    = '/upload';
        return $refDir;
    }

    public function createUploadImageConfig($size)
    {
        $fileCreator = $this->getFileCreator();

        $fileCreator->setTemplate('template/module/config/upload-image.config.phtml');
        $fileCreator->setOptions(array(
            'entityName' => $this->getEntityName(),
            'uploadDir'  => $this->getUploadDir(),
            'refDir'     => $this->getRefDir(),
            'size'       => $size
        ));
        $fileCreator->setFileName('upload-image.config.php');
        $fileCreator->setLocation($this->getModule()->getConfigExtFolder());

        //$fileCreator->debug();

        return $fileCreator->render();
    }


    public function generateEmptyUploadImageLine($tableNameUrl)
    {
        $line = <<<EOS
        '$tableNameUrl' => array(
            'pre' => array(100, 100),
            'lg' => array(800, 800),
            'md' => array(600, 600),
            'sm' => array(400, 400),
            'xs' => array(200, 200),
        ),

EOS;
        return $line;
    }

    public function generateUploadImageSpecialityLine($specialityName)
    {
        $line = <<<EOS
        '$specialityName' => array(
            'pre' => array(100, 100),
            'sm' => array(400, 400),
            'xs' => array(200, 200),
        ),

EOS;
        return $line;
    }

    public function convertUploadImageArrayToString($name, $sizes)
    {
        $line = <<<EOS
        '$name' => array(

EOS;

        foreach ($sizes as $i => $size) {
            $line .= <<<EOS
            '$i' => array($size[0***REMOVED***, $size[1***REMOVED***),

EOS;
        }

        $line .= <<<EOS
        ),

EOS;

        return $line;
    }
}

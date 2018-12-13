<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use Gear\Schema\Db\Db;

class UploadImageManager extends AbstractConfigManager implements ModuleManagerInterface
{
    public function module(array $controllers)
    {
        $this->getFileCreator()->createFile(
            'template/module/config/empty-upload-image.phtml',
            [***REMOVED***,
            'upload-image.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function mergeUploadImageConfigAssociationFromDb(Db $db)
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

        $sizeAggregate = [***REMOVED***;
        $size = '';

        if (!empty($uploadImageConfig)) {
            $sizeAggregate = $uploadImageConfig['size'***REMOVED***;
            $size .= $this->convertArrayBackToString($sizeAggregate, true);
        }

        $size .= $this->generateEmptyUploadImageLine($this->tableNameUrl);
        return $this->createUploadImageConfig($size);
    }

    public function mergeUploadImageColumnFromDb(Db $db)
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

        $uploadImageColumns = $this->db->getColumnManager()->filter(['Gear\Column\Varchar\UploadImage'***REMOVED***);

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
                    $this->getDirService()->mkDir($dir);
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
        $uploadDir = 'public/upload';
        return $uploadDir;
    }

    /**
     * Pasta de referencia para imagens usada no arquivo upload-image.config.php
     * @return string
     */
    public function getRefDir()
    {
        $refDir    = 'upload';
        return $refDir;
    }

    public function createUploadImageConfig($size)
    {
        $fileCreator = $this->getFileCreator();

        $fileCreator->setTemplate('template/module/config/upload-image.config.phtml');
        $fileCreator->setOptions([
            'entityName' => $this->getEntityName(),
            'uploadDir'  => $this->getUploadDir(),
            'refDir'     => $this->getRefDir(),
            'size'       => $size
        ***REMOVED***);
        $fileCreator->setFileName('upload-image.config.php');
        $fileCreator->setLocation($this->getModule()->getConfigExtFolder());

        //$fileCreator->debug();

        return $fileCreator->render();
    }


    public function generateEmptyUploadImageLine($tableNameUrl)
    {
        $line = <<<EOS
        '$tableNameUrl' => [
            'pre' => [100, 100***REMOVED***,
            'lg' => [800, 800***REMOVED***,
            'md' => [600, 600***REMOVED***,
            'sm' => [400, 400***REMOVED***,
            'xs' => [200, 200***REMOVED***,
        ***REMOVED***,

EOS;
        return $line;
    }

    public function generateUploadImageSpecialityLine($specialityName)
    {
        $line = <<<EOS
        '$specialityName' => [
            'pre' => [100, 100***REMOVED***,
            'sm' => [400, 400***REMOVED***,
            'xs' => [200, 200***REMOVED***,
        ***REMOVED***,

EOS;
        return $line;
    }

    public function convertUploadImageArrayToString($name, $sizes)
    {
        $line = <<<EOS
        '$name' => [

EOS;

        foreach ($sizes as $i => $size) {
            $line .= <<<EOS
            '$i' => [$size[0***REMOVED***, $size[1***REMOVED******REMOVED***,

EOS;
        }

        $line .= <<<EOS
        ***REMOVED***,

EOS;

        return $line;
    }
}

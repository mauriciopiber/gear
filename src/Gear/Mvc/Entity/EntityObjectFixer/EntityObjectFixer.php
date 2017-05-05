<?php
namespace Gear\Mvc\Entity\EntityObjectFixer;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObject;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/Entity/EntityObjectFixer
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class EntityObjectFixer
{
    use StringServiceTrait;

    protected $entitiesObjects = [***REMOVED***;

    /**
     * Constructor
     *
     * @param StringService $stringService String Service
     *
     * @return \Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer
     */
    public function __construct(StringService $stringService)
    {
        $this->stringService = $stringService;

        return $this;
    }

    /**
     * Do the job
     */
    public function fixEntities($moduleName, array $entities)
    {
        $this->moduleName = $moduleName;

        foreach ($entities as $entityFile) {
            $entity = new EntityObject($entityFile);

            $this->fixEntity($entity);
            $this->persistEntity($entity);
        }
    }

    /**
     * Return Module Name
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    public function fixEntity($entity)
    {
        $this->snifferErrors($entity);
        $this->docsErrors($entity);
        $this->userEntity($entity);
    }

    public function snifferErrors($entity)
    {

        $originalContent = $entity->getContent();
        $content = explode(PHP_EOL, $originalContent);

        $lineNumber = 0;

        while ($lineNumber < count($content)) {
            $line = $content[$lineNumber***REMOVED***;
            $lineNumber += 1;

            //pega validação no caso do nome da tabela estar expressa em uma só linha.
            $pattern = '/ * @ORM\\\\Table/';
            if (preg_match($pattern, $line, $match) && strlen($line) > 120) {
                $newCode = $this->breakDoctrineTableNotation($line);
                $originalContent = str_replace($line, $newCode, $originalContent);
                continue;
            }

            //limpa última linha em branco
            $pattern = '/     \* @return [a-zA-Z\\\***REMOVED****\s$/';
            if (preg_match($pattern, $line, $match)) {
                $newCode = $this->breakEmptyChar($line);
                $originalContent = str_replace($line, $newCode, $originalContent);
                continue;
            }

            if (strlen($line) > 120) {
                //se for declaração de Join Column
                $pattern = '/    public function [a-zA-Z***REMOVED****/';

                if (preg_match($pattern, $line, $match)) {
                    $newCode = $this->breakLongFunctionName($line);
                    $originalContent = str_replace($line.'    {', $newCode, $originalContent);
                    //$this->breakFunctionParenteses($lineNumber+1);
                }

                $pattern = '/     \*   @ORM\\\\JoinColumn/';

                if (preg_match($pattern, $line, $match)) {
                     $newCode = $this->breakLongORMJoinColumn($line);
                     $originalContent = str_replace($line, $newCode, $originalContent);
                }
            }

        }

        $entity->setContent($originalContent);

    }


    public function breakLongFunctionName($line)
    {
        $pieces = explode('(', $line);

        $method = trim($pieces[0***REMOVED***);

        $shortParts = explode(' ', $pieces[1***REMOVED***);

        $last = trim(str_replace(')', '', $shortParts[3***REMOVED***));

        $functionCall = <<<EOS
    $method(
        {$shortParts[0***REMOVED***} {$shortParts[1***REMOVED***} {$shortParts[2***REMOVED***} {$last}
    ) {
EOS;

        return $functionCall;
    }


    public function breakLongORMJoinColumn($line)
    {
        $pieces = explode('"', $line);


        $functionCall = <<<EOS
     *   @ORM\JoinColumn(
     *       name="{$pieces[1***REMOVED***}",
     *       referencedColumnName="{$pieces[3***REMOVED***}"
     *   )
EOS;
        return $functionCall;
    }

    public function breakEmptyChar($line)
    {
        return rtrim($line).PHP_EOL;
    }

    public function breakDoctrineTableNotation($line)
    {
        $pattern = '/ * @ORM\\\\Table\(name=[\'"***REMOVED***(\w*)[\'"***REMOVED***/';

        if (!preg_match($pattern, $line, $match)) {
            throw new \Exception('Entity as not created sucessful');
        }

        $tableDirty = array_pop($match);
        $tableDirty = str_replace(' * @ORM\\Table(name="', '', $tableDirty);
        $tableName = str_replace('"', '', $tableDirty);

        $pattern = '/@ORM\\\\Index\(name=[\'"***REMOVED***(\w*)[\'"***REMOVED***, columns={[\'"***REMOVED***(\w*)[\'"***REMOVED***}\)/';

        if (preg_match_all($pattern, $line, $matches)) {
            $indexes = $matches[0***REMOVED***;
            if (count($indexes)>0) {
                return $this->transformNotation($tableName, $indexes);
            }
        }

        return $line;
    }


    public function transformNotation($tableName, $indexes)
    {
        $tableIndexes = '';
        foreach ($indexes as $number => $index) {
            if ($number+1 >= count($indexes)) {
                $singleIndex = <<<EOL
 *         $index

EOL;
            } else {
                $singleIndex = <<<EOL
 *         $index,

EOL;
            }

            $tableIndexes .= $singleIndex;
        }

        $module = $this->getModuleName();

        $notation = <<<EOL
 * PHP Version 5
 *
 * @category Entity
 * @package {$module}/Entity
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 *
 * @ORM\Table(
 *     name="$tableName",
 *     indexes={
$tableIndexes *     }
 * )
 * @SuppressWarnings(PHPMD)

EOL;

        return $notation;
    }


    public function getAttributeDate($column, $nullable = true)
    {
        $columnUline = $this->str('uline', $column);
        $columnVar = $this->str('var', $column);

        $nullT = ' nullable=%s';
        $nullV = ($nullable) ? 'true' : false;
        $nullT = sprintf($nullT, $nullV);

        $attribute = <<<EOS

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="{$columnUline}", type="datetime"{$nullT})
     */
    private \${$columnVar};

EOS;
        return $attribute;

    }

    public function getSetterDate($tableName, $column)
    {
        $setter    = <<<EOS

    /**
     * Set updated
     *
     * @param \DateTime \$updated
     *
     * @return {$tableName}
     */
    public function setUpdated(\$updated)
    {
        \$this->updated = \$updated;

        return \$this;
    }

EOS;

    }

    public function getGetterDate($column)
    {
        $columnUline = $this->str('uline', $column);
        $columnClass = $this->str('class', $column);
        $columnVar = $this->str('var', $column);

        $getter    = <<<EOS

    /**
     * Get {$columnUline}
     *
     * @return \DateTime
     */
    public function get{$columnClass}()
    {
        return \$this->{$columnVar};
    }

EOS;

        return $getter;
    }

    public function getAttributeForeignKey($column)
    {
        $columnUline = $this->str('uline', $column);
        $columnVar = $this->str('var', $column);

        $attribute = <<<EOS

    /**
     * @var \GearAdmin\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="GearAdmin\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="{$columnUline}", referencedColumnName="id_user")
     * })
     */
    private \${$columnVar};

EOS;
        return $attribute;


    }

    public function getSetterForeignKey($tableName, $column)
    {
        $columnUline = $this->str('uline', $column);
        $columnVar = $this->str('var', $column);
        $columnClass = $this->str('var', $column);

        $setter    = <<<EOS

    /**
     * Set {$columnVar}
     *
     * @param \GearAdmin\Entity\User \${$columnVar}
     *
     * @return {$tableName}
     */
    public function set{$columnClass}(\GearAdmin\Entity\User \${$columnVar} = null)
    {
        \$this->{$columnVar} = \${$columnVar};

        return \$this;
    }

EOS;

        return $setter;

    }

    public function getGetterForeignKey($column)
    {
        $columnUline = $this->str('uline', $column);
        $columnVar = $this->str('var', $column);
        $columnClass = $this->str('var', $column);

        $getter    = <<<EOS

    /**
     * Get {$columnVar}
     *
     * @return \GearAdmin\Entity\User
     */
    public function get{$columnClass}()
    {
        return \$this->{$columnVar};
    }

EOS;

        return $getter;
    }

    public function strReplace(&$entity, $subject, $target)
    {
        $entity->setContent(str_replace($subject, $target, $entity->getContent()));
    }

    /*
    public function pregReplace(&$subject, $target)
    {
        $entity->setContent(preg_replace($subject, $target, $entity->getContent()));
    }
    */

    public function userEntity(EntityObject &$entity)
    {

        $content = $entity->getContent();

        $userNamespace = sprintf('\%s\Entity\User', $this->getModuleName());
        $fixNamespace = '\GearAdmin\Entity\User';

        $userName = sprintf('%s\Entity\User', $this->getModuleName());
        $fixName  = 'GearAdmin\Entity\User';


        $content = str_replace($userNamespace, $fixNamespace, $content);
        $content = str_replace($userName, $fixName, $content);

        //created by
        $this->strReplace($entity, $this->getAttributeForeignKey('createdBy'), '');
        $this->strReplace($entity, $this->getSetterForeignKey($entity->getTableName(), 'createdBy'), '');
        $this->strReplace($entity, $this->getGetterForeignKey('createdBy'), '');

        $this->strReplace($entity, $this->getAttributeForeignKey('updatedBy'), '');
        $this->strReplace($entity, $this->getSetterForeignKey($entity->getTableName(), 'updatedBy'), '');
        $this->strReplace($entity, $this->getGetterForeignKey('updatedBy'), '');

        $this->strReplace($entity, $this->getAttributeDate('created', false), '');
        $this->strReplace($entity, $this->getSetterDate($entity->getTableName(), 'created'), '');
        $this->strReplace($entity, $this->getGetterDate('created'), '');

        $this->strReplace($entity, $this->getAttributeDate('updated'), '');
        $this->strReplace($entity, $this->getSetterDate($entity->getTableName(), 'updated'), '');
        $this->strReplace($entity, $this->getGetterDate('updated'), '');

        if (strpos('use \GearBase\Entity\LogTrait;', $content) === false) {

            preg_match('/class [a-zA-Z***REMOVED****\n{/', $content, $match, PREG_OFFSET_CAPTURE);

            $strToInsert = PHP_EOL.'    use \GearBase\Entity\LogTrait;'.PHP_EOL;

            $content = substr($content, 0, ($match[0***REMOVED***[1***REMOVED***+strlen($match[0***REMOVED***[0***REMOVED***)))
                . $strToInsert
                . substr($content, ($match[0***REMOVED***[1***REMOVED***+strlen($match[0***REMOVED***[0***REMOVED***)));
        }

        $entity->setContent($content);
    }

    public function docsErrors(EntityObject &$entity)
    {
        $content = $entity->getContent();

        $pattern = '/@param [\a-zA-Z***REMOVED**** \$[a-zA-Z0-9***REMOVED****\n/';

        preg_match_all($pattern, $content, $matches);

        foreach ($matches[0***REMOVED*** as $exact) {
            $explode = explode(PHP_EOL, $exact);
            $param = $explode[0***REMOVED***;

            $all = explode(' ', $param);
            $name = end($all);
            $name = str_replace('$', '', $name);

            $label = $this->str('label', $name);

            $replacement = $param.' '.$label.'\n';

            $content = str_replace($exact, $replacement, $content);
        }

        $entity->setContent($content);
    }


    /**
     * Função responsável por substituir entidade no disco.
     * @param String $fileName
     * @return boolean
     */
    public function persistEntity($entity)
    {
        return file_put_contents($entity->getFile(), $entity->getContent());
    }
}
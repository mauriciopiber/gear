<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class SearchService extends AbstractJsonService
{
    public function getLocation()
    {
        return $this->getModule()->getSearchFolder();
    }

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractSearchForm.php')) {
            return true;
        } else {
            return false;
        }
    }


    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/form/search/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractSearchForm.php',
                $this->getModule()->getSearchFolder()
            );
        }
    }


    public function introspectFromTable($src)
    {

        $this->getAbstract();


        $this->createFileFromTemplate(
            'template/src/form/search/full.search.phtml',
            array(
                'class'   => $src->getTable(),
                'var'     => $this->str('var', $src->getTable()),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getTable().'SearchForm.php',
            $this->getModule()->getSearchFolder()
        );
    }

}

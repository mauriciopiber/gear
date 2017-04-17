<?php
namespace Gear\UserType\Service;

use Gear\UserType\Service\UserTypeServiceInterface;

class All implements UserTypeServiceInterface
{
    public function getServiceSelectById($repository, $label = null, $entity = null)
    {

        return <<<EOS
    /**
     * Select one {$label} by Id.
     *
     * @param array \$idToSelect Id
     *
     * @return null|{$entity}
     */
    public function selectById(\$idToSelect)
    {
        \$repository = \$this->get{$repository}();
        return \$repository->selectById(\$idToSelect);
    }

EOS;
    }

    public function getServiceSelectAll()
    {
        return <<<EOS
        return parent::selectAll(\$select);

EOS;
    }

    public function getServiceSelectViewById($repository)
    {
        return '';
    }
}

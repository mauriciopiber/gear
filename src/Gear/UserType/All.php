<?php
namespace Gear\UserType;

class All
{

    public function getServiceAttributes()
    {

    }

    public function getServiceFunctions()
    {

    }


    public function getServiceSelectById($repository)
    {

        return <<<EOS
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

}

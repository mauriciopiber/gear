<?php
namespace Gear\UserType;

class LowStrict
{
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
        if (!isset(\$resultSet)) {
            \$resultSet = \$repository->selectAll(\$select, \$this->getOrderBy(), \$this->getOrder());
        }

EOS;
    }
}

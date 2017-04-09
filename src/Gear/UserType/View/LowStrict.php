<?php
namespace Gear\UserType\View;

class LowStrict implements UserTypeViewInterface
{
    public function getUserIdList()
    {
        return PHP_EOL.'        {{ id = <?php echo $this->id;?> }}'.PHP_EOL;
    }
}

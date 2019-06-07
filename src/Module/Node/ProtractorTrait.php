<?php
namespace Gear\Module\Node;

use Gear\Module\Node\Protractor;

trait ProtractorTrait
{
    protected $protractor;

    public function getProtractor()
    {
        return $this->protractor;
    }

    public function setProtractor(Protractor $protractor)
    {
        $this->protractor = $protractor;
        return $this;
    }
}

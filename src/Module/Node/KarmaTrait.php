<?php
namespace Gear\Module\Node;

use Gear\Module\Node\Karma;

trait KarmaTrait
{
    protected $karma;

    public function getKarma()
    {
        if (!isset($this->karma)) {
            $this->karma = $this->getServiceLocator()->get('Gear\Module\Node\Karma');
        }
        return $this->karma;
    }

    public function setKarma(Karma $karma)
    {
        $this->karma = $karma;
        return $this;
    }
}

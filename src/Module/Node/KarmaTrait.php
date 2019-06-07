<?php
namespace Gear\Module\Node;

use Gear\Module\Node\Karma;

trait KarmaTrait
{
    protected $karma;

    public function getKarma()
    {
        return $this->karma;
    }

    public function setKarma(Karma $karma)
    {
        $this->karma = $karma;
        return $this;
    }
}

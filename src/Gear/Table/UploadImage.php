<?php
namespace Gear\Table;

use Gear\Service\AbstractJsonService;

class UploadImage extends AbstractJsonService {

    public function getFixtureLoad($table)
    {

        $var = $this->str('var', $table);
        $class = $this->str('class', $table);
        $url = $this->str('url', $table);

        return <<<EOS
            \$this->createUploadImageTableFixture('$url', \${$var}, \$imageEntity);

EOS;
    }

    public function getFixturePreLoad()
    {
        return <<<EOS
        \$imageEntity = '\\{$this->getModule()->getModuleName()}\Entity\UploadImage';

EOS;
    }
}

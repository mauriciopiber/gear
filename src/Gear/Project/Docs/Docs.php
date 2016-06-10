<?php
namespace Gear\Project\Docs;

use Gear\Service\AbstractJsonService;

class Docs extends AbstractJsonService
{
    public function __construct()
    {

    }

    public function createIndex()
    {
        return true;
    }

    public function createConfig()
    {
        return true;
    }

    public function createReadme()
    {
        return true;
    }
}

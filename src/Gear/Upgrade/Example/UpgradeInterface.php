<?php
namespace Gear\Project\Upgrade;

interface UpgradeInterface
{
    public function create();

    public function update();

    public function upgrade();
}

<?php
namespace Gear\Database;

trait BackupServiceTrait
{
    protected $backupService;

    public function setBackupService($backupService)
    {
        $this->backupService = $backupService;
    }

    public function getBackupService()
    {
        return $this->backupService;
    }
}

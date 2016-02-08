<?php
namespace Gear\Database;

trait BackupServiceTrait {

    protected $backupService;

    public function setBackupService($backupService)
    {
        $this->backupService = $backupService;
    }

    public function getBackupService()
    {
        if (!isset($this->backupService)) {
            $this->backupService = $this->getServiceLocator()->get('backupService');
        }
        return $this->backupService;
    }
}

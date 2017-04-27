<?php
namespace Gear\Integration\Component\MigrationFile;

use Gear\Integration\Component\MigrationFile\MigrationFileFactory;

trait MigrationFileTrait
{
    protected $migrationFile;

    /**
     * Get Migration File
     *
     * @return Gear\Integration\Component\MigrationFile\MigrationFile
     */
    public function getMigrationFile()
    {
        if (!isset($this->migrationFile)) {
            $name = 'Gear\Integration\Component\MigrationFile\MigrationFile';
            $this->migrationFile = $this->getServiceLocator()->get($name);
        }
        return $this->migrationFile;
    }

    /**
     * Set Migration File
     *
     * @param MigrationFile $migrationFile Migration File
     *
     * @return \Gear\Integration\Component\MigrationFile\MigrationFile
     */
    public function setMigrationFile(
        MigrationFile $migrationFile
    ) {
        $this->migrationFile = $migrationFile;
        return $this;
    }
}

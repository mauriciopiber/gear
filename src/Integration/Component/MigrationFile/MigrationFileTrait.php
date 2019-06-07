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

<?php
namespace Gear\Service\Db;

class BackupService extends DbAbstractService
{
    public function getBackupName()
    {
        $name = $this->getRequest()->getParam('name', null);

        if (!$name) {
            $backupName = sprintf(
                '%s_backup_%s.txt',
                $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***,
                date('H.i.s.d.m.Y')
            );

            return $backupName;
        }
        return $name;
    }

    public function getLocation()
    {
        $location = $this->getRequest()->getParam('location');
        if (realpath($location) == false) {
            return false;
        }
        return $location;
    }

    public function init()
    {
        $this->config = $this->getServiceLocator()->get('config');
        $this->username = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['user'***REMOVED***;
        $this->password = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['password'***REMOVED***;
        $this->dbname   = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***;
    }

    public function mysqlDump($dbms = 'mysql')
    {
        $this->init();

        $this->file = sprintf(
            '%s%s',
            $this->getLocation(),
            $this->getBackupName()
        );

        $command = sprintf(
            "mysqldump -u %s --password=%s --opt %s > %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );
        exec($command);

        if (is_file($this->file)) {
            echo sprintf('Criado %s', $this->getBackupName())."\n";
            echo sprintf($this->file)."\n";
        } else {
            throw new \Exception('Dump não foi criado com sucesso');
        }
        return true;
    }

    public function mysqlLoad($dbms = 'mysql')
    {
        $this->init();

        $this->file = sprintf(
            '%s',
            $this->getLocation()
        );

        if (!is_file($this->file)) {
            throw new \Exception("Arquivo não é um dump válido");
        }

        $command = sprintf(
            "mysql -u %s --password=%s %s < %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        exec($command);

        if (is_file($this->file)) {
            echo sprintf('Carregado backup de %s', $this->file)."\n";
        } else {
            throw new \Exception('Dump não foi criado com sucesso');
        }
        return true;
    }

}

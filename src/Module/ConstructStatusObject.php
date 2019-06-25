<?php
namespace Gear\Module;

use Zend\Console\Adapter\Posix as Console;

class ConstructStatusObject
{
    private $skipped = [***REMOVED***;

    private $created = [***REMOVED***;

    private $validated = [***REMOVED***;

    public function __construct(Console $console)
    {
        $this->console = $console;
    }

    public function getSkipped() : array
    {
        return $this->skipped;
    }

    public function setSkipped(array $skipped)
    {
        $this->skipped = $skipped;
        return $this;
    }

    public function addSkipped(string $skipped)
    {
        $this->skipped[***REMOVED*** = $skipped;
        return $this;
    }

    public function hasSkipped() : bool
    {
        return !empty($this->skipped);
    }

    public function getCreated() : array
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function addCreated($created)
    {
        $this->created[***REMOVED*** = $created;
        return $this;
    }

    public function hasCreated()
    {
        return !empty($this->created);
    }

    public function getValidated()
    {
        return $this->validated;
    }

    public function setValidated($validated)
    {
        $this->validated = $validated;
        return $this;
    }

    public function addValidated($validated)
    {
        if (is_array($validated)) {
            $this->validated = array_merge($this->validated, $validated);
            return $this;
        }

        $this->validated[***REMOVED*** = $validated;
        return $this;
    }

    public function hasValidated()
    {
        return !empty($this->validated);
    }

    public function render()
    {
        if ($this->hasCreated()) {
            foreach ($this->getCreated() as $msg) {
                $this->console->writeLine($msg, 0, 3);
            }
        }

        if ($this->hasSkipped()) {
            foreach ($this->getSkipped() as $msg) {
                $this->console->writeLine($msg, 0, 4);
            }
        }

        if ($this->hasValidated()) {
            foreach ($this->getValidated() as $msg) {
                $this->console->writeLine($msg, 0, 2);
            }
        }
    }

    public function merge(ConstructStatusObject $status)
    {
        if ($status->hasCreated()) {
            foreach ($status->getCreated() as $msg) {
                $this->setCreated($msg);
            }
        }

        if ($status->hasSkipped()) {
            foreach ($status->getSkipped() as $msg) {
                $this->setSkipped($msg);
            }
        }

        if ($status->hasValidated()) {
            foreach ($status->getValidated() as $msg) {
                $this->setValidated($msg);
            }
        }
        unset($status);
        return $this;
    }
}

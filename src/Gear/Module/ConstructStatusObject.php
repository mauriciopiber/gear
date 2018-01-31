<?php
namespace Gear\Module;

class ConstructStatusObject
{
    private $skipped = [***REMOVED***;

    private $created = [***REMOVED***;

    private $validated = [***REMOVED***;

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
}

<?php
namespace Gear\Integration\Suite\Integration;

use Gear\Integration\Suite\Integration\IntegrationFactory;

trait IntegrationTrait
{
    protected $integration;

    /**
     * Get Integration
     *
     * @return Gear\Integration\Suite\Integration\Integration
     */
    public function getIntegration()
    {
        if (!isset($this->integration)) {
            $name = 'Gear\Integration\Suite\Integration\Integration';
            $this->integration = $this->getServiceLocator()->get($name);
        }
        return $this->integration;
    }

    /**
     * Set Integration
     *
     * @param Integration $integration Integration
     *
     * @return \Gear\Integration\Suite\Integration\Integration
     */
    public function setIntegration(
        Integration $integration
    ) {
        $this->integration = $integration;
        return $this;
    }
}

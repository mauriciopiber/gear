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

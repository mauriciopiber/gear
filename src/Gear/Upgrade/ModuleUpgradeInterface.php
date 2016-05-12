<?php
namespace Gear\Upgrade;

/**
 * Interface responsável por controlar o fluxo de upgrades em modulos.
 * Caso haja uma nova tipagem de upgrade, adicionar método à interface.
 * Atualmente há:
 * 1. Cli
 * 2. Web
 */
interface ModuleUpgradeInterface
{
    /**
     * Faz o upgrade de modulos Web Gear, que é o principal componente dos produtos oferecidos
     * Logo será feito uma documentação retratando.
     */
    public function upgradeWebModule();

    /**
     * Faz o upgrade de modulos Cli Gear, que é o principal componente dos produtos oferecidos
     * Logo será feito uma documentação retratando.
     */
    public function upgradeCliModule();


}

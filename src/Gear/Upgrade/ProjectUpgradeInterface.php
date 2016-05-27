<?php
namespace Gear\Upgrade;

/**
 * Interface responsável por controlar o fluxo de upgrades em projetos.
 * Caso haja uma nova tipagem de upgrade, adicionar método à interface.
 */
interface ProjectUpgradeInterface
{
    /**
     * Faz o upgrade de projetos Web Gear, que é o principal produto oferecido
     * Logo será feito uma documentação retratando.
     */
    public function upgradeProject();
}

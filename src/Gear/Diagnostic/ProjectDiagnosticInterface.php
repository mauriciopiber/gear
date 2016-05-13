<?php
namespace Gear\Diagnostic;

/**
 * Interface responsável por controlar diagnóstico em modulos.
 * Caso haja uma nova tipagem de diagnóstico, adicionar método à interface.
 * Atualmente há:
 * 1. Cli
 * 2. Web
 */
interface ProjectDiagnosticInterface
{
    /**
     * Faz o diagnóstico do modulos Web Gear, que é o principal componente dos produtos oferecidos
     * Logo será feito uma documentação retratando.
     */
    public function diagnosticProjectWeb();
}

<?php
namespace Gear\Model;

/**
 *
 * @author piber
 *         Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class NavigationGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    /**
     */
    public function getBigMarketConfig()
    {
        return [
            'admin' => [
                'admin',
                'arquivo',
                'tipo_arquivo',
                'configuracao',
                'configuracao_tag',
                'moeda',
                'recorrencia',
                'tag',
                'imagem'
            ***REMOVED***,
            'pagina' => [
                'pagina',
                'pagina_tag'
            ***REMOVED***,
            'contato' => [
                'contato',
                'email'
            ***REMOVED***,
            'banner' => [
                'banner'
            ***REMOVED***,
            'produto' => [
                'produto',
                'produto_categoria',
                'produto_funcionalidade',
                'produto_opcional',
                'produto_preco',
                'produto_tag',
                'categoria',
                'categoria_tag',
                'marca',
                'marca_tag',
                'funcionalidade',
                'tipo_funcionalidade'
            ***REMOVED***,
            'pedido' => [
                'pedido',
                'pedido_comprador',
                'pedido_contato',
                'pedido_pagamento',
                'pedido_pagamento_status',
                'pedido_produto',
                'pedido_status',
                'pagamento_paypal',
                'tipo_pagamento',
                'assinatura_status',
                'pagseguro',
                'pagseguro_log',
                'paypal_status'
            ***REMOVED***,
            'pessoa' => [
                'endereco',
                'endereco_estrangeiro',
                'pessoa',
                'pessoa_fisica',
                'pessoa_juridica',
                'pessoa_estrangeira',
                'tipo_pessoa',
                'estado'
            ***REMOVED***
        ***REMOVED***;
    }
}

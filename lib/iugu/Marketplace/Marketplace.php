<?php

namespace Iugu\Marketplace;

use bubbstore\Iugu\Services\BaseRequest;

class Marketplace extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Listar Contas
     * 
     * Lista as contas de um marketplace ou parceiro de negócios
     *
     * @return void
     */
    public function getMarketplaces()
    {
        $this->sendApiRequest('GET', 'marketplace');

        return $this->fetchResponse();
    }

    /**
     * create
     *
     * Cria um novo marketplace.
     *
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'marketplace/create_account');

        return $this->fetchResponse();
    }

    /**
     * Update
     *
     * Atualiza uma subconta.
     *
     * @param  int $id
     * @param  array $params 
     * @return array
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('accounts/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Envia uma verificação de subconta
     *
     * @param  int $id
     * @param  array $params 
     * @return array
     */
    public function requestVerification($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', sprintf('accounts/%s/request_verification', $id));

        return $this->fetchResponse();
    }

    /**
     * Show
     *
     * Retorna os dados da subconta
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->sendApiRequest('GET', sprintf('accounts/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * requestWithdraw
     *
     * Faz um pedido de Saque de um valor.
     *
     * @param  int $id 
     * @param  array $params 
     * @return array
     */
    public function requestWithdraw($id, array $params)
    {
        $this->sendApiRequest('POST', sprintf('accounts/%s/request_withdraw', $id));

        return $this->fetchResponse();
    }
}

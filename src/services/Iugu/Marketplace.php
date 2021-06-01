<?php

namespace services\Iugu;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\BaseRequest;
use GuzzleHttp\ClientInterface;

/**
 * Class Marketplace.
 *
 * @package namespace services\Iugu;
 */
class Marketplace extends BaseRequest
{

    /**
     * Marketplace constructor.
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Listar subcontas
     *
     * Lista as contas de um marketplace ou parceiro de negócios
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function list()
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
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
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
     * @param int $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('accounts/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Envia uma verificação de subconta
     *
     * @param int $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
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
     * @param int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
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
     * @param int $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function requestWithdraw($id, array $params)
    {
        $this->sendApiRequest('POST', sprintf('accounts/%s/request_withdraw', $id));

        return $this->fetchResponse();
    }
}

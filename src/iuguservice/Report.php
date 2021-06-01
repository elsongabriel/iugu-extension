<?php

namespace iuguservice;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\BaseRequest;
use GuzzleHttp\ClientInterface;

/**
 * Class Report.
 *
 * @package namespace services\Iugu;
 */
class Report extends BaseRequest
{

    /**
     * Report constructor.
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Retorna a lista de todas as transferências bancárias.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function listWithdrawRequests()
    {
        $this->sendApiRequest('GET', 'withdraw_requests');

        return $this->fetchResponse();
    }

    /**
     * Retorna as informações de uma transferência bancária.
     *
     * @param int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function getWithdrawRequests($id)
    {
        $this->sendApiRequest('GET', sprintf('withdraw_requests/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Retorna o extrato financeiro de uma conta.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function financialStatement(array $params = [])
    {
        $this->setParams($params)->sendApiRequest('GET', 'accounts/financial');

        return $this->fetchResponse();
    }

    /**
     * Retorna o extrato de faturas de uma conta.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function invoicesStatement(array $params = [])
    {
        $this->setParams($params)->sendApiRequest('GET', 'accounts/invoices');

        return $this->fetchResponse();
    }

    /**
     * Retorna todos os pedidos de saques criados em ambiente de produção (LIVE)
     * que tenham um determinado status e tenham sido atualizados em determinado período (entre frome to).
     * No caso de marketplaces ou parceiros de negócios,
     * retorna também os pedidos de saques de subcontas que atendam a esses critérios.
     *
     * @param int $start
     * @param int $limit
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function withdrawConciliations($start, $limit)
    {
        $this->sendApiRequest('GET', sprintf('withdraw_conciliations?start=$s&limit=$s', $start, $limit));

        return $this->fetchResponse();
    }

    /**
     * Listar pagamentos
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function paymentRequests()
    {
        $this->sendApiRequest('GET', 'payment_requests');

        return $this->fetchResponse();
    }

    /**
     * Buscar pagamento
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function searchPayment($id)
    {
        $this->sendApiRequest('GET', sprintf('payment_requests/$s', $id));

        return $this->fetchResponse();
    }
}
<?php

namespace IuguServices\Iugu;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\BaseRequest;
use GuzzleHttp\ClientInterface;

/**
 * Class Subscription.
 *
 * @package namespace services\Iugu;
 */
class Subscription extends BaseRequest
{

    /**
     * Subscription constructor.
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Cria uma Assinatura
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'subscriptions');

        return $this->fetchResponse();
    }

    /**
     * Retorna uma lista com as assinaturas geradas pela sua conta, ordenadas pela data de criação, da mais nova para a mais antiga.
     * O nó totalItems retorna sempre a quantidade total de assinaturas cadastradas, independentemente dos parâmetros de pesquisa utilizados,
     * e o resultado da pesquisa fica sempre dentro de items. Por padrão, retorna no máximo 100 itens.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'subscriptions');

        return $this->fetchResponse();
    }

    /**
     * Retorna os dados de uma Assinatura.
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function search($id)
    {
        $this->sendApiRequest('GET', "subscriptions/{$id}");

        return $this->fetchResponse();
    }

    /**
     * Ativa uma Assinatura. Uma Fatura poderá ser gerada para o cliente.
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function activate($id)
    {
        $this->sendApiRequest('POST', "subscriptions/{$id}/activate");

        return $this->fetchResponse();
    }

    /**
     * Suspende uma Assinatura.
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function suspend($id)
    {
        $this->sendApiRequest('POST', "subscriptions/{$id}/suspend");

        return $this->fetchResponse();
    }

    /**
     * Altera os dados de uma Assinatura, quaisquer parâmetros não informados não serão alterados.
     *
     * @param string $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', "subscriptions/{$id}");

        return $this->fetchResponse();
    }

    /**
     * Simula a alteração de plano de uma assinatura.
     *
     * @param string $id
     * @param string $plan_identifier
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function changePlanSimulation($id, $plan_identifier)
    {
        $this->sendApiRequest('PUT', "subscriptions/{$id}/change_plan_simulation/{$plan_identifier}");

        return $this->fetchResponse();
    }

    /**
     * Simula a alteração de plano de uma assinatura.
     *
     * @param string $id
     * @param string $plan_identifier
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function changePlan($id, $plan_identifier)
    {
        $this->sendApiRequest('PUT', "subscriptions/{$id}/change_plan/{$plan_identifier}");

        return $this->fetchResponse();
    }

    /**
     * Remove uma Assinatura permanentemente.
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function removeSubscription($id)
    {
        $this->sendApiRequest('DELETE', "subscriptions/{$id}");

        return $this->fetchResponse();
    }

}

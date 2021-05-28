<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Subscription.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Subscription extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Cria uma Assinatura
     *
     * @param  array $params 
     * @return array 
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
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'subscriptions');

        return $this->fetchResponse();
    }

    /**
     * Retorna os dados de uma Assinatura.
     *
     * @param  string $id
     * @return array
     */
    public function search($id)
    {
        $this->sendApiRequest('GET', sprintf('subscriptions/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Ativa uma Assinatura. Uma Fatura poderá ser gerada para o cliente.
     *
     * @param  string $id
     * @return array
     */
    public function activate($id)
    {
        $this->sendApiRequest('POST', sprintf('subscriptions/$s/activate', $id));

        return $this->fetchResponse();
    }

    /**
     * Suspende uma Assinatura.
     *
     * @param  string $id
     * @return array
     */
    public function suspend($id)
    {
        $this->sendApiRequest('POST', sprintf('subscriptions/$s/suspend', $id));

        return $this->fetchResponse();
    }

    /**
     * Altera os dados de uma Assinatura, quaisquer parâmetros não informados não serão alterados.
     *
     * @param  string $id
     * @param  array $params
     * @return array
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('subscriptions/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Simula a alteração de plano de uma assinatura.
     *
     * @param  string $id
     * @param  string $plan_identifier
     * @return array
     */
    public function changePlanSimulation($id, $plan_identifier)
    {
        $this->sendApiRequest('PUT', sprintf('subscriptions/$s/change_plan_simulation/$s', $id, $plan_identifier));

        return $this->fetchResponse();
    }

    /**
     * Simula a alteração de plano de uma assinatura.
     *
     * @param  string $id
     * @param  string $plan_identifier
     * @return array
     */
    public function changePlan($id, $plan_identifier)
    {
        $this->sendApiRequest('PUT', sprintf('subscriptions/$s/change_plan/$s', $id, $plan_identifier));

        return $this->fetchResponse();
    }

    /**
     * Remove uma Assinatura permanentemente.
     *
     * @param  string $id
     * @return array
     */
    public function removeSubscription($id)
    {
        $this->sendApiRequest('DELETE', sprintf('subscriptions/$s', $id));

        return $this->fetchResponse();
    }

}

<?php

namespace IuguServices\Iugu;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\BaseRequest;
use GuzzleHttp\ClientInterface;

/**
 * Class Plan.
 *
 * @package namespace services\Iugu;
 */
class Plan extends BaseRequest
{
    
    /**
     * Plan constructor
     *
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Retorna uma lista com todos os planos em sua conta ordenadas pela data de Criação,
     * sendo o primeiro o criado mais recentemente. O campo totalItems contém sempre a quantidade de planos cadastrados,
     * independente dos parâmetros de pesquisa utilizados e o resultado da pesquisa fica sempre dentro de items.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'plans');

        return $this->fetchResponse();
    }

    /**
     * Cria um plano.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'plans');

        return $this->fetchResponse();
    }

    /**
     * Altera os dados de um Plano,
     * quaisquer parâmetros não informados não serão alterados.
     * As alterações não irão mudar as Assinaturas que já utilizam o Plano, mas só as novas.
     *
     * @param int $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('plans/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Retorna os dados de um Plano.
     *
     * @param int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function get($id)
    {
        $this->sendApiRequest('GET', sprintf('plans/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Retorna os dados de um Plano.
     *
     * @param int $identifier
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function getByIdentifier($identifier)
    {
        $this->sendApiRequest('GET', sprintf('plans/identifier/$s', $identifier));

        return $this->fetchResponse();
    }

    /**
     * Remove os dados de um Plano
     *
     * @param int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function destroy($id)
    {
        $this->sendApiRequest('DELETE', sprintf('plans/$s', $id));

        return $this->fetchResponse();
    }

}

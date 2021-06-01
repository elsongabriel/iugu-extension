<?php

namespace iuguservice;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\BaseRequest;
use GuzzleHttp\ClientInterface;

/**
 * Class Split.
 *
 * @package namespace services\Iugu;
 */
class Split extends BaseRequest
{

    /**
     * Split constructor.
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Permite a criação de multi splits para uma conta.
     * Criar um novo multi split sobrepõe o que já está configurado.
     * Todas as faturas pagas em uma conta irão respeitar as regras de splits criadas
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create(array $params)
    {
        $this->setParams(['split_rules' => $params])->sendApiRequest('POST', 'splits');

        return $this->fetchResponse();
    }

    /**
     * Consulta a lista de splits da conta.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'splits');

        return $this->fetchResponse();
    }

    /**
     * Consulta um splits da conta.
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function search($id)
    {
        $this->sendApiRequest('GET', sprintf('splits/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Consulta o split atualmente cadastrado na conta.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function current()
    {
        $this->sendApiRequest('GET', 'splits/current');

        return $this->fetchResponse();
    }

}

<?php

namespace iuguservice;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\BaseRequest;
use GuzzleHttp\ClientInterface;

/**
 * Class Master.
 *
 * @package namespace services\Iugu;
 */
class Master extends BaseRequest
{

    /**
     * Master constructor.
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * createBankVerificantion
     *
     * Envia dados para cadastrar ou alterar o domicílio
     * bancário da conta que recebe saques e transferências.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function createBankVerificantion(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'bank_verification');

        return $this->fetchResponse();
    }

    /**
     * getBankVerificantion
     *
     * Consultar dados enviados para alterar domicílio bancário.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function showBankVerificantion()
    {
        $this->sendApiRequest('GET', 'bank_verification');

        return $this->fetchResponse();
    }

    /**
     * requestCreditCardVerification
     *
     * Envia dados para verificação de cartão de crédito
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function requestCreditCardVerification(array $params)
    {
        $params['document_legal'] = base64_encode($params['document_legal']);

        $params['document_individual_cnh'] = $this->_fileEnconde($params, 'document_individual_cnh');
        $params['document_individual_cpf'] = $this->_fileEnconde($params, 'document_individual_cpf');

        $this->setParams($params)->sendApiRequest('POST', 'credit_card_verification');

        return $this->fetchResponse();
    }

    /**
     * checkCreditCardVerification
     *
     * Consultar dados enviados para uso de cartão de crédito
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function checkCreditCardVerification()
    {
        $this->sendApiRequest('GET', 'credit_card_verification');

        return $this->fetchResponse();
    }

    /**
     * Configuração dos pagamentos pix.
     * Habilitar/Desabilitar
     *
     * @param bool $enable
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function settingPix(bool $enable)
    {
        $this->setParams(['enable' => $enable])->sendApiRequest('PUT', 'payments/pix');

        return $this->fetchResponse();
    }

    /**
     * Encode file for base64
     *
     * @param array $array
     * @param string $key
     * @return string|null
     */
    private function _fileEnconde($array, $key)
    {
        if (isset($array[$key])) {
            return base64_encode($array[$key]);
        } else {
            return null;
        }
    }

    /**
     * Retorna configuração atual da gestão de cobranças.
     *
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function consultManagement()
    {
        $this->sendApiRequest('GET', 'dunning_steps');

        return $this->fetchResponse();
    }

    /**
     * Alterar a configuração da gestão de cobranças.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function updateManagement(array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', 'dunning_steps');

        return $this->fetchResponse();
    }

}

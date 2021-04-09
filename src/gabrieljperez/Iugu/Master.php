<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Master.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Master extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * createBankVerificantion
     * 
     * Envia dados para cadastrar ou alterar o domicílio 
     * bancário da conta que recebe saques e transferências.
     *
     * @param  array $params 
     * @return void
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
     * @param  array $params 
     * @return array
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
     */
    public function settingPix(bool $enable)
    {
        $this->setParams(['enable' => $enable])->sendApiRequest('PUT', 'payments/pix');

        return $this->fetchResponse();
    }

    /**
     * Encode file for base64
     *
     * @param  array $array 
     * @param  string $key 
     * @return void
     */
    private function _fileEnconde($array, $key)
    {
        if(isset($array[$key])) {
            return base64_encode($array[$key]);
        } else {
            return null;
        }
    }

    /**
     * Retorna configuração atual da gestão de cobranças.
     *
     * @return array
     */
    public function consultManagement()
    {
        $this->sendApiRequest('GET', 'dunning_steps');

        return $this->fetchResponse();
    }

    /**
     * Alterar a configuração da gestão de cobranças.
     *
     * @param  array $params
     * @return array
     */
    public function updateManagement(array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', 'dunning_steps');

        return $this->fetchResponse();
    }

}

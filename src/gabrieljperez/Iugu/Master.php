<?php

namespace Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Master.
 *
 * @package namespace Iugu;
 */
class Master extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Post Bank
     * 
     * Envia dados para cadastrar ou alterar o domicílio 
     * bancário da conta que recebe saques e transferências.
     *
     * @param  array $params 
     * @return void
     */
    public function postBank(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'bank_verification');

        return $this->fetchResponse();
    }

    /**
     * getBank
     *
     * Consultar dados enviados para alterar domicílio bancário.
     *
     * @return array
     */
    public function getBank()
    {
        $this->sendApiRequest('GET', 'bank_verification');

        return $this->fetchResponse();
    }

    /**
     * postCreditCardVerification
     *
     * Envia dados para verificação de cartão de crédito
     *
     * @param  array $params 
     * @return array
     */
    public function postCreditCardVerification(array $params)
    {
        $params['document_legal'] = base64_encode($params['document_legal']);
        
        $params['document_individual_cnh'] = $this->_fileEnconde($params, 'document_individual_cnh');
        $params['document_individual_cpf'] = $this->_fileEnconde($params, 'document_individual_cpf');

        $this->setParams($params)->sendApiRequest('POST', 'credit_card_verification');

        return $this->fetchResponse();
    }

    /**
     * getCreditCardVerification
     *
     * Envia dados para verificação de cartão de crédito
     *
     * @return array
     */
    public function getCreditCardVerification()
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
    public function ConsultManagement()
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

<?php

namespace services\Iugu;

use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Services\Customer as BaseCustomer;
use GuzzleHttp\ClientInterface;

/**
 * Class Customer.
 *
 * @package namespace services\Iugu;
 */
class Customer extends BaseCustomer
{

    /**
     * Customer constructor.
     * @param ClientInterface $http
     * @param Iugu $iugu
     */
    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Cria uma nova cobrança.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function createPaymentToken(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'payment_token');

        return $this->fetchResponse();
    }

}

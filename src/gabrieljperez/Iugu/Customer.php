<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\Customer as BaseCustomer;

/**
 * Class Customer.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Customer extends BaseCustomer
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Cria uma nova cobrança.
     *
     * @param array $params
     * @return array
     */
    public function createPaymentToken(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'payment_token');

        return $this->fetchResponse();
    }

}

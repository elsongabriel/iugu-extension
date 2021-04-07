<?php

namespace Iugu;

use bubbstore\Iugu\Iugu as baseIugu;

use Iugu\Marketplace\Marketplace;

class Iugu extends baseIugu
{
    /**
     * Marketplace
     *
     * @var Iugu\Marketplace\MarketPlace
     */
    protected $Marketplace;

    public function __construct()
    {
        parent::__construct($this->_getApiKey());

        $this->Marketplace = new Marketplace($this->http, $this);
    }

    /**
     * Get api key
     * 
     * @return string
     */
    private function _getApiKey()
    {
        if (config('app.debug')) {
            $key = config('services.iugu.api_test_key');
        } else {
            $key = config('services.iugu.api_key');
        }

        return $key;
    }

    /**
     * Get account Id
     * 
     * @return string
     */
    public function getAccountId()
    {
        return config('services.iugu.account_id');
    }

    /**
     * Marketplace
     * 
     * @return Iugu\MarketPlace\Marketplace 
     */
    public function marketplace()
    {
        return $this->Marketplace;
    }
}
<?php

namespace Iugu;

use bubbstore\Iugu\Iugu as baseIugu;

use Iugu\Marketplace;
use Iugu\Master;
use Iugu\Split;

/**
 * Class Iugu.
 *
 * @package namespace Iugu;
 */
class Iugu extends baseIugu
{
    /**
     * Marketplace
     *
     * @var \App\Iugu\MarketPlace
     */
    protected $Marketplace;

    /**
     * Master
     * 
     * @var \App\Iugu\Master
     */
    protected $Master;

    /**
     * Split
     * 
     * @var \App\Iugu\Split
     */
    protected $Split;

    public function __construct()
    {
        parent::__construct($this->_getApiKey());

        $this->Marketplace = new Marketplace($this->http, $this);
        $this->Master = new Master($this->http, $this);
        $this->Split = new Split($this->http, $this);
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
     * @return App\Iugu\Marketplace 
     */
    public function marketplace()
    {
        return $this->Marketplace;
    }

    /**
     * Master account settings
     *
     * @return App\Iugu\Master
     */
    public function master()
    {
        return $this->Master;
    }

    /**
     * Split
     *
     * @return App\Iugu\Split
     */
    public function Split()
    {
        return $this->Split;
    }
}
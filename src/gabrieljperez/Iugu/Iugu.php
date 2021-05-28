<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Iugu as baseIugu;

/**
 * Class Iugu.
 *
 * @package namespace gabrieljperez\Iugu;
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

    /**
     * Report
     * 
     * @var \App\Iugu\Report
     */
    protected $Report;

    /**
     * Plan
     * 
     * @var \App\Iugu\Plan
     */
    protected $Plan;

    /**
     * Subscription
     * 
     * @var \App\Iugu\Subscription
     */
    protected $Subscription;

    const BANKS                     = [
        'Itaú', 'Bradesco', 'Caixa Econômica', 'Banco do Brasil', 'Santander', 'Banrisul', 'Sicredi', 'Sicoob', 'Inter', 'BRB', 'Via Credi', 'Neon', 'Votorantim', 'Nubank', 'Pagseguro', 'Banco Original', 'Safra', 'Modal', 'Banestes','Unicred','Money Plus','Mercantil do Brasil','JP Morgan','Gerencianet Pagamentos do Brasil', 'Banco C6', 'BS2', 'Banco Topazio', 'Uniprime', 'Stone', 'Banco Daycoval', 'Rendimento', 'Banco do Nordeste', 'Citibank', 'PJBank', 'Cooperativa Central de Credito Noroeste Brasileiro', 'Uniprime Norte do Paraná', 'Global SCM', 'Next', 'Cora', 'Mercado Pago', 'Banco da Amazonia', 'BNP Paribas Brasil', 'Juno','Cresol','BRL Trust DTVM','Banco Banese'
    ];

    const PERSON_TYPES              = [
        'Pessoa Física', 'Pessoa Jurídica'
    ];

    const PERSON_TYPE_PHYSICAL      = 'Pessoa Física';
    const PERSON_TYPE_LEGAL         = 'Pessoa Jurídica';

    const INTERVAL_TYPES            = [ 
        'weeks', 'months'
    ];

    const INTERVAL_TYPE_WEEKS      = 'weeks';
    const INTERVAL_TYPE_MONTHS     = 'months';

    const PAYABLE_WITHS            = [
        'all', 'credit_card', 'bank_slip', 'pix'
    ];

    const PAYABLE_WITH_ALL         = 'all';
    const PAYABLE_WITH_CREDIT_CARD = 'credit_card';
    const PAYABLE_WITH_BANK_SLIP   = 'bank_slip';
    const PAYABLE_WITH_PIX         = 'pix';

    public function __construct($apiKey = null)
    {
        parent::__construct(($apiKey !== null) ? $apiKey : $this->_getApiKey());

        $this->Marketplace  = new Marketplace($this->http, $this);
        $this->Master       = new Master($this->http, $this);
        $this->Split        = new Split($this->http, $this);
        $this->Report       = new Report($this->http, $this);
        $this->Plan         = new Plan($this->http, $this);
        $this->Subscription = new Subscription($this->http, $this);
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
    public function split()
    {
        return $this->Split;
    }

    /**
     * Report
     *
     * @return App\Iugu\Report
     */
    public function report()
    {
        return $this->Report;
    }

    /**
     * Plan
     *
     * @return App\Iugu\Plan
     */
    public function plan()
    {
        return $this->Plan;
    }

    /**
     * Subscription
     *
     * @return App\Iugu\Subscription
     */
    public function subscription()
    {
        return $this->Subscription;
    }
}
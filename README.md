# Iugu-extension

Biblioteca base utilizada [egcservices/iugu-php-sdk](https://github.com/elsongabriel/iugu-php-sdk)

Biblioteca que realiza integração com a API da [Iugu](http://www.iugu.com)

[![StyleCI](https://styleci.io/repos/140902040/shield?branch=master)](https://styleci.io/repos/140902040)

## Instalação via composer

```bash
$ composer require egcservices/iugu-extension
```

## Serviços

Este SDK extende os seguintes serviços:

- [Marketplace/Ações da Conta Mestre](https://dev.iugu.com/reference#criar-subconta)
- [Split](https://dev.iugu.com/reference#criar-split-1)
- [Relatórios](https://dev.iugu.com/reference#extrato-financeiro)
- [Planos](https://dev.iugu.com/reference#criar-plano)

[Referência da API](https://dev.iugu.com/reference)  
[Documentação iugu-php-sdk](https://github.com/elsongabriel/iugu-php-sdk)

### Configuração

Para utilizar este SDK, será necessário inserir em seu .env

```php
IUGU_API_KEY=CHAVE_API_IUGU
IUGU_API_TEST_KEY=CHAVE_DE_TEST_API_IUGU
IUGU_ACCOUNT_ID=ID_DA_CONTA_MASTER
```

E em config/services.php 

```php
'iugu' => [
    'account_id'   => env('IUGU_ACCOUNT_ID', ''),
    'api_test_key' => env('IUGU_API_TEST_KEY', ''),
    'api_key'      => env('IUGU_API_KEY', ''),
]
```

Ao realizar use das classes, será necessario fazer o seguinte e instaciar a classe iugu

```php
use services\Iugu\Iugu;
use egcservices\Iugu\Exceptions\IuguException;
use egcservices\Iugu\Exceptions\IuguValidationException;

$iugu = new Iugu;
// Também possivel setar apitoken na chamada da classe
$iugu = new Iugu('apiKey');
```

### MarketPlace

#### Listar subcontas

```php
$response = $iugu->marketplace()->list();

// Imprime uma lista de subcontas
echo $response;
```

#### Criar MarketPlace

- [Referência](https://dev.iugu.com/reference#criar-subconta)

```php
$response = $iugu->marketplace()->create([
    'parametros'
]);

// Imprime o ID da subconta
dd($response);
```

#### Editar MarketPlace

- [Referência](https://dev.iugu.com/reference#atualizar-subconta)

```php
$response = $iugu->marketplace()->update('SUBCONTA_ID',[
    'parametros'
]);

// Imprime a subconta atualizada
dd($response);
```

#### Enviar verificação de subconta
- [Referência](https://dev.iugu.com/reference#enviar-verificacao-de-conta)
```php
$response = $iugu->marketplace()->requestVerification('SUBCONTA_ID',[
    'parametros'
]);

dd($response);
```

#### Ver subconta

- [Referência](https://dev.iugu.com/reference#atualizar-subconta)

```php
$response = $iugu->marketplace()->show('SUBCONTA_ID');

dd($response);
```

#### Pedido de saque

```php
$response = $iugu->marketplace()->requestWithdraw('SUBCONTA_ID');

dd($response);

```

### Master

#### Adicionar Domicílio Bancário
- [Referência](https://dev.iugu.com/reference#adicionar-domicilio-bancario)
```php
    $iugu->master()->createBankVerificantion(['parametros']);
```

#### Verificar Envio de Domicilio Bancario
- [Referência](https://dev.iugu.com/reference#verificar-envio-de-domicilio-bancario)
```php
    $iugu->master()->showBankVerificantion();
```

#### Solicitar verificação para uso de Cartão de Crédito
:warning: O documento de comprovante de Contrato Social ou documento de Atividade é obrigatório  
Além deste documento é necessário enviar (CNH ou RG) ou CPF caso não possua CNH.

- [Referência](https://dev.iugu.com/reference#solicitar-verifica%C3%A7%C3%A3o-para-uso-de-cart%C3%A3o-de-cr%C3%A9dito)
```php
    $iugu->master()->requestCreditCardVerification(['parametros']);
```

#### Verificar Solicitação de cartão de crédito

- [Referência](https://dev.iugu.com/reference#verificar-solicita%C3%A7%C3%A3o-de-cart%C3%A3o-de-cr%C3%A9dito)
```php
    $iugu->master()->checkCreditCardVerification();
```

#### Configurar Pagamentos
Habilita ou Desabilita o Pix.  
- [Referência](https://dev.iugu.com/reference#configurar-pagamentos)
```php
    $iugu->master()->settingPix(TRUE or FALSE)
```

#### Consultar Gestão de Cobranças.
- [Referência](https://dev.iugu.com/reference#reenviar-gatilho-por-per%C3%ADodo)
```php
    $iugu->master()->ConsultManagement()
```

### Alterar Gestão de Cobranças.
- [Referência](https://dev.iugu.com/reference#alterar-gest%C3%A3o-1)
```php
    $iugu->master()->updateManagement()
```

### Multi Split
:warning: Criar um novo multi split sobrepõe o que já está configurado. Todas as faturas pagas em uma conta irão respeitar as regras de splits criadas.
#### Criar split
- [Referencia](https://dev.iugu.com/reference#criar-split-1)
```php
$response = $iugu->split()->create(['parametros']);

dd($response);
```

#### Listar splits

```php
$response = $iugu->split()->list();

dd($response);
```

#### Visualizar split

```php
$response = $iugu->split()->search('split_id');

dd($response);
```

#### Consultar splits

```php
$response = $iugu->split()->current('split_id');

dd($response);
```

#### Planos

### Listar um plano

- [Referência](https://dev.iugu.com/reference#listar-plano)
```php
$response = $iugu->plan->list();

dd($response);
```

### criar um plano

- [Paramentros](https://dev.iugu.com/reference#criar-plano)
```php
$response = $iugu->plan->create(['paramentros']);

dd($response);
```

### Alterar um Plano
- [Paramentros](https://dev.iugu.com/reference#alterar-plano)
```php
$response = $iugu->plan->update('id', ['paramentros']);

dd($response);
```

### Remover Plano
- [referência](https://dev.iugu.com/reference#remover-plano)
```php
$response = $iugu->plan->destroy('id');

dd($response);
```

### Buscar Plano
- [referência](https://dev.iugu.com/reference#buscar-plano)
```php
$response = $iugu->plan->get('id');

dd($response);
```

### Buscar Plano pelo Identificador
- [referência](https://dev.iugu.com/reference#buscar-plano-pelo-identificador)
```php
$response = $iugu->plan->getByIdentifier('identifier');

dd($response);
```

### alterar um plano

#### Helps

Consts

```php
// Obtenha um array com todos os bancos aceitos pela Iugu
const BANKS = [
    'Itaú', 'Bradesco', 'Caixa Econômica', ...
]

const PERSON_TYPE = [
    'Pessoa Física', 'Pessoa Jurídica'
];

const PERSON_TYPE_PHYSICAL = 'Pessoa Física';
const PERSON_TYPE_LEGAL    = 'Pessoa Jurídica';

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
```



# iugu-php-sdk

Biblioteca que realiza integração com a API da [Iugu](http://www.iugu.com)

[![StyleCI](https://styleci.io/repos/140902040/shield?branch=master)](https://styleci.io/repos/140902040)
[![Maintainability](https://api.codeclimate.com/v1/badges/d4e66f98ad0539e0b65d/maintainability)](https://codeclimate.com/github/egcservices/iugu-php-sdk/maintainability)

## Instalação via composer

```bash
$ composer require egcservices/iugu-php-sdk
```

## Serviços

Este SDK suporta os seguintes serviços:

- [Clientes](https://dev.iugu.com/reference#testinput-2)
- [Cobrança direta](https://dev.iugu.com/reference#cobranca-direta)
- [Faturas](https://dev.iugu.com/reference#criar-fatura)
- [Métodos de pagamento](https://dev.iugu.com/reference#testinput-3)

[Referência da API](https://dev.iugu.com/reference)

### Configuração

Para utilizar este SDK, será necessário utilizar seu token de acesso de sua conta Iugu.

```php
use egcservices\Iugu;
use egcservices\Iugu\Exceptions\IuguException;
use egcservices\Iugu\Exceptions\IuguValidationException;

$iugu = new Iugu('SEU_TOKEN');
```

### Clientes

#### Criar cliente

```php
$customer = $iugu->customer()->create([
    'name' => 'Lucas Colette',
    'email' => 'lucas@bubb.com.br',
]);

// Imprime o ID do cliente
echo $customer['id'];
```

#### Atualizar cliente

```php
$customer = $iugu->customer()->update('ID_CLIENTE', [
    'name' => 'John'
]);
```

#### Buscar cliente

```php
$customer = $iugu->customer()->find('ID_CLIENTE');

var_dump($customer);
```

#### Excluir cliente

```php
$iugu->customer()->delete('ID_CLIENTE');
```

### Cobranças diretas

#### Criar cobrança com boleto bancário

```php
$charge = $iugu->charge()->create([
            'method' => 'bank_slip',
            'email' => 'lucas@bubb.com.br',
            'order_id' => uniqid(),
            'payer' => [
                'cpf_cnpj' => '65634052076',
                'name' => 'Lucas Colette',
                'phone_prefix' => '11',
                'phone' => '11111111',
                'email' => 'lucas@bubb.com.br',
                'address' => [
                    'street' => 'Foo Bar',
                    'number' => '123',
                    'district' => 'Foo',
                    'city' => 'Foo',
                    'state' => 'SP',
                    'zip_code' => '14940000',
                ],
            ],
            'items' => [
                [
                    'description' => 'Item 1',
                    'quantity' => 1,
                    'price_cents' => 1000
                ],
                [
                    'description' => 'Item 2',
                    'quantity' => 2,
                    'price_cents' => 2000
                ],
            ],
        ]);
```

#### Realizar pagamento de uma fatura com cartão

```php
$charge = $iugu->charge()->create([
    'invoice_id' => '12345678',
    'token' => '0000000000000000' // Token gerado através da lib iugu.js
]);
```

## Faturas

#### Criar fatura

```php
$invoice = $iugu->invoice()->create([
    'order_id' => uniqid(),
    'email' => 'lucas@bubb.com.br',
    'due_date' => '2018-07-14',
    'notification_url' => 'https://webhook.site/08703bf2-d408-4f4c-b91c-0bc8e14352b2',
    'fines' => false,
    'per_day_interest' => false,
    'discount_cents' => 500,
    'ignore_due_email' => true,
    'payable_with' => 'bank_slip',
    'items' => [
        [
            'description' => 'Item 1',
            'quantity' => 1,
            'price_cents' => 1000
        ],
        [
            'description' => 'Item 2',
            'quantity' => 2,
            'price_cents' => 2000
        ],
        [
            'description' => 'Frete',
            'quantity' => 1,
            'price_cents' => 1000
        ],
    ],
    'payer' => [
        'cpf_cnpj' => '65634052076',
        'name' => 'Lucas Colette',
        'phone_prefix' => '11',
        'phone' => '11111111',
        'email' => 'lucas@bubb.com.br',
        'address' => [
            'street' => 'Foo Bar',
            'number' => '123',
            'district' => 'Foo',
            'city' => 'Foo',
            'state' => 'SP',
            'zip_code' => '14940000',
        ],
    ],
]);

// Imprime o ID da fatura
echo $invoice['id'];
```

#### Capturar fatura

```php
$iugu->invoice()->capture('ID_FATURA');
```

#### Buscar fatura

```php
$iugu->invoice()->find('ID_FATURA');
```

#### Reembolsar fatura

```php
$iugu->invoice()->refund('ID_FATURA');
```

#### Cancelar fatura

```php
$iugu->invoice()->cancel('ID_FATURA');
```

## Métodos de pagamento

#### Criar método de pagamento

```php
$payment = $iugu->paymentMethod()->create('ID_CLIENTE', [
    'description' => 'Cartão de Crédito',
    'token' => '123456',
]);

// Imprime o ID do pagamento
echo $payment['id'];
```

#### Atualizar método de pagamento

```php
$iugu->paymentMethod()->update('ID_CLIENTE', 'ID_METODO_PAGAMENTO', [
    'description' => 'Outra description',
]);
```

#### Buscar método de pagamento

```php
$iugu->paymentMethod()->find('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
```

#### Excluir método de pagamento

```php
$iugu->paymentMethod()->delete('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
```

## Testando

```bash
$ composer test
```

## Change log

Consulte [CHANGELOG](.github/CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Contribuindo

Consulte [CONTRIBUTING](.github/CONTRIBUTING.md) para obter mais detalhes.

## Segurança

Se você descobrir quaisquer problemas relacionados à segurança, envie um e-mail para contato@bubbstore.com.br em vez de usar as issues.

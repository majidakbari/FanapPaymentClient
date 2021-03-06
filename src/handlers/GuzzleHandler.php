<?php

namespace makbari\fanapPaymentClient\handlers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use makbari\fanapPaymentClient\exceptions\CanNotConnectToServerException;
use makbari\fanapPaymentClient\exceptions\UnAuthorizedException;
use makbari\fanapPaymentClient\interfaces\iHandler;
use Psr\Http\Message\ResponseInterface;

class GuzzleHandler implements iHandler
{


    /**
     * @var Client
     */
    protected $httpClient;


    /**
     * @var string
     */
    protected $serverUrl;


    /**
     * GuzzleHandler constructor.
     *
     * @param Client $client
     * @param $serverUrl
     */
    public function __construct(Client $client, $serverUrl)
    {
        $this->httpClient = $client;
        $this->serverUrl = $serverUrl;
    }


    /**
     * @param ResponseInterface $response
     * @param bool $assos
     * @return mixed
     */
    protected function getResult(ResponseInterface $response, $assos = true)
    {
        return json_decode($response->getBody()->getContents(), $assos);
    }


    /**
     * @param $method
     * @return string
     */
    protected function endpoint($method)
    {
        switch ($method) {

            case 'getBusinessId':
                return $this->serverUrl . '/nzh/biz/getBusiness';
                break;
            case 'followDigipeyk':
                return $this->serverUrl . '/nzh/follow/';
                break;
            case 'getOneTimeToken':
                return $this->serverUrl . '/nzh/ott/';
                break;
            case 'createInvoice':
                return $this->serverUrl . '/nzh/biz/issueInvoice/';
            case 'closeInvoice' :
                return $this->serverUrl . '/nzh/biz/closeInvoice/';
                break;
            case 'cancelInvoice':
                return $this->serverUrl . '/nzh/biz/cancelInvoice/';
                break;
            case 'getInvoice':
                return $this->serverUrl . '/nzh/biz/getInvoiceList/';
        }

        return '';
    }

    /**
     * @param string $apiToken
     * @return array
     * @throws CanNotConnectToServerException
     * @throws UnAuthorizedException
     */
    public function getBusinessId(string $apiToken): array
    {
        try {
            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'headers' => [
                    '_token_' => $apiToken,
                    '_token_issuer_' => 1
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }

    /**
     * @param string $token
     * @param bool $follow
     * @param $businessId
     * @return array
     * @throws CanNotConnectToServerException
     */
    public function followDigipeyk(string $token, int $businessId, bool $follow = true): array
    {

        try {
            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'query' => [
                    'follow'         => 'true',
                    'businessId'     => $businessId
                ],
                'headers' => [
                    '_token_'        => $token,
                    '_token_issuer_' => 1,
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }

    /**
     * @param string $apiToken
     * @return array
     * @throws CanNotConnectToServerException
     */
    public function getOneTimeToken(string $apiToken): array
    {
        try {
            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'headers' => [
                    '_token_'        => $apiToken,
                    '_token_issuer_' => 1
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }

    /**
     * @param string $apiToken
     * @param string $ott
     * @param string $redirectUrl
     * @param int $userId
     * @param string $productId
     * @param int $price
     * @param string $productDescription
     * @param int $quantity
     * @param string $guildCode
     * @param int $addressId
     * @param int $preferredTaxRate
     * @return array
     * @throws CanNotConnectToServerException
     */
    public function createInvoice(
        string $apiToken,
        string $ott,
        string $redirectUrl,
        int $userId,
        string $productId,
        int $price,
        string $productDescription,
        int $quantity,
        string $guildCode,
        int $addressId,
        int $preferredTaxRate
    ): array
    {

        try {

            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'query' => [
                    'redirectURL'       => $redirectUrl,
                    'userId'            => $userId,
                    'productId[]'         => $productId,
                    'price[]'             => $price,
                    'productDescription[]'=> $productDescription,
                    'quantity[]'          => $quantity,
                    'guildCode'         => $guildCode,
                    'addressId'         => $addressId,
                    'preferredTaxRate'  => $preferredTaxRate
                ],
                'headers' => [
                    '_token_'           => $apiToken,
                    '_token_issuer_'    => 1,
                    '_ott_'             => $ott
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }

    /**
     * @param int $invoiceId
     * @param string $apiToken
     * @return array
     * @throws CanNotConnectToServerException
     */
    public function closeInvoice(int $invoiceId, string $apiToken): array
    {
        try {
            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'query' => [
                    'id' => $invoiceId
                ],
                'headers' => [
                    '_token_'           => $apiToken,
                    '_token_issuer_'    => 1,
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }

    /**
     * @param string $apiToken
     * @param int $invoiceId
     * @return array
     * @throws CanNotConnectToServerException
     */
    public function cancelInvoice(string $apiToken, int $invoiceId): array
    {
        try {
            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'query' => [
                    'id' => $invoiceId
                ],
                'headers' => [
                    '_token_'           => $apiToken,
                    '_token_issuer_'    => 1,
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }

    /**
     * @param string $apiToken
     * @param int $invoiceId
     * @return array
     * @throws CanNotConnectToServerException
     */
    public function getInvoice(string $apiToken, int $invoiceId): array
    {
        try {
            $response = $this->httpClient->get($this->endpoint(__FUNCTION__), [
                'query' => [
                    'id'      => $invoiceId,
                    'firstId' => 0

                ],
                'headers' => [
                    '_token_'           => $apiToken,
                    '_token_issuer_'    => 1,
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }
}

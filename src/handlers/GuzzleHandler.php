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
                return $this->serverUrl . ':8081/nzh/biz/getBusiness';
                break;
        }
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
                'query' => [
                    '_token_' => $apiToken,
                    '_token_issuer_' => 1
                ]
            ]);
        } catch (ConnectException $e) {
            throw new CanNotConnectToServerException();
        }

        return $this->getResult($response);
    }
}

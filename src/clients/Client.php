<?php
namespace makbari\fanapOauthClient;

use makbari\fanapPaymentClient\exceptions\UnAuthorizedException;
use makbari\fanapPaymentClient\interfaces\iClient;
use makbari\fanapPaymentClient\interfaces\iHandler;

/**
 * Class Client
 * @package mhndev\digipeyk\services\oauth2
 */
class Client implements iClient
{

    /**
     * @var iHandler
     */
    protected $handler;

    /**
     * Client constructor.
     * @param iHandler $handler
     */
    public function __construct(iHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param string $apiToken
     * @return int
     * @throws UnAuthorizedException
     */
    function getBusinessId(string $apiToken): int
    {
        $result = $this->handler->getBusinessId($apiToken);
        if ($result['hasError']){
            throw new UnAuthorizedException();
        }

        return (int) $result['result']['id'];
    }
}

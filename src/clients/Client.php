<?php
namespace makbari\fanapPaymentClient\clients;

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
     * @return array
     * @throws UnAuthorizedException
     */
    function getBusinessId(string $apiToken): array
    {
        $result = $this->handler->getBusinessId($apiToken);
        if ($result['hasError']){
            throw new UnAuthorizedException();
        }

        return  $result;
    }


    /**
     * @param string $token
     * @param int $businessId
     * @param bool $follow
     * @return bool
     * @throws UnAuthorizedException
     */
    function followDigipeyk(string $token, int $businessId, bool $follow = true): bool
    {
        $result = $this->handler->followDigipeyk($token, $businessId, $follow);
        if ($result['hasError']){
            throw new UnAuthorizedException();
        }

        return $result['result'];
    }

    /**
     * @param string $apiToken
     * @return string
     * @throws UnAuthorizedException
     */
    function getOneTimeToken(string $apiToken): string
    {
        $result = $this->handler->getOneTimeToken($apiToken);
        if ($result['hasError']){
            throw new UnAuthorizedException();
        }

        return $result['ott'];
    }
}

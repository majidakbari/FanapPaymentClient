<?php
namespace makbari\fanapPaymentClient\clients;

use makbari\fanapPaymentClient\exceptions\PaymentException;
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
     * @throws PaymentException
     */
    function createInvoice(
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
        $result = $this->handler->createInvoice(
             $apiToken,
             $ott,
             $redirectUrl,
             $userId,
             $productId,
             $price,
             $productDescription,
             $quantity,
             $guildCode,
             $addressId,
             $preferredTaxRate
        );

        if ($result['hasError']){
            throw new PaymentException();
        }

        return $result['result'];
    }

    /**
     * @param int $invoiceId
     * @param string $apiToken
     * @return array
     * @throws PaymentException
     */
    function closeInvoice(int $invoiceId, string $apiToken): array
    {
        $result = $this->handler->closeInvoice($invoiceId,$apiToken);

        if ($result['hasError']){
            throw new PaymentException();
        }
        return $result;
    }

    /**
     * @param string $apiToken
     * @param int $invoiceId
     * @return bool
     * @throws PaymentException
     */
    function cancelInvoice(string $apiToken, int $invoiceId): bool
    {
        $result = $this->handler->closeInvoice($invoiceId,$apiToken);

        if ($result['hasError']){
            throw new PaymentException();
        }

        return $result['result'];
    }
}

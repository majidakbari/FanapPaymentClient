<?php

namespace makbari\fanapPaymentClient\interfaces;

/**
 * Interface iHandler
 * @package makbari\fanapPaymentClient\interfaces
 */
interface iHandler
{

    /**
     * @param string $apiToken
     * @return mixed
     */
    function getBusinessId(string $apiToken) :array ;

    /**
     * @param string $token
     * @param bool $follow
     * @param int $businessId
     * @return array
     */
    function followDigipeyk(string $token, int $businessId, bool $follow = true) :array;


    /**
     * @param string $apiToken
     * @return array
     */
    function getOneTimeToken(string $apiToken) :array ;

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
     */
    function createInvoice(
        string $apiToken,
        string $ott,
        string $redirectUrl,
        int    $userId,
        string $productId,
        int    $price,
        string $productDescription,
        int    $quantity,
        string $guildCode,
        int    $addressId,
        int    $preferredTaxRate
    ) :array ;

    /**
     * @param int $invoiceId
     * @param string $apiToken
     * @return array
     */
    function closeInvoice(int $invoiceId, string $apiToken ) :array ;
}

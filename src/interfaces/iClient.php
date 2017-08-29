<?php

namespace makbari\fanapPaymentClient\interfaces;

/**
 * Interface iClient
 * @package makbari\fanapPaymentClient\interfaces
 */
interface iClient
{
    /**
     * @param string $apiToken
     * @return mixed
     */
    function getBusinessId(string $apiToken) :array;

    /**
     * @param string $token
     * @param bool $follow
     * @param int $businessId
     * @return bool
     */
    function followDigipeyk(string $token, int $businessId, bool $follow = true) :bool;

    /**
     * @param string $apiToken
     * @return string
     */
    function getOneTimeToken(string $apiToken) :string;


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



    /**
     * @param string $apiToken
     * @param int $invoiceId
     * @return bool
     */
    function cancelInvoice(string $apiToken, int $invoiceId) :bool ;


}
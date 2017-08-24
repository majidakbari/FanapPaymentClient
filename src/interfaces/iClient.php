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

}
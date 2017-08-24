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
    function getBusinessId(string $apiToken) :array;

    /**
     * @param string $token
     * @param bool $follow
     * @param int $businessId
     * @return array
     */
    function followDigipeyk(string $token, int $businessId, bool $follow = true) :array;
}

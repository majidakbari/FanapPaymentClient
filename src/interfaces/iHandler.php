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
}

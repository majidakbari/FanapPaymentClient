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
    function getBusinessId(string $apiToken) :int;

}
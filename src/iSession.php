<?php

namespace ns1\ops;

/**
 * Interface iSession
 * @package ns1\ops
 */
interface iSession
{
    /**
     * @return mixed
     */
    public static function logout();
    public static function clear();
}
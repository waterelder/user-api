<?php

namespace AppBundle\Enum;

abstract class UserState
{
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';

    public static function getAll()
    {
        return array(
            self::ACTIVE,
            self::INACTIVE,
        );
    }
}

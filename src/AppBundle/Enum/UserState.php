<?php
/**
 * Created by PhpStorm.
 * User: lex
 * Date: 25.05.17
 * Time: 0:47
 */

namespace AppBundle\Enum;


abstract class UserState
{
    const ACTIVE = "ACTIVE";
    const INACTIVE = "INACTIVE";


    public static function getAll()
    {
        return array(
            self::ACTIVE,
            self::INACTIVE,
        );
    }

}
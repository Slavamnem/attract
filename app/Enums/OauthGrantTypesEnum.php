<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.12.2019
 * Time: 22:53
 */

namespace App\Enums;

class OauthGrantTypesEnum extends AbstractEnum
{
    const CLIENT_CREDENTIALS = 1;
    const REFRESH = 2;

    /**
     * @var array
     */
    protected $enums = [
        self::CLIENT_CREDENTIALS  => 'client_credentials',
        self::REFRESH => 'refresh',
    ];

    /**
     * @param $type
     * @return OauthGrantTypesEnum
     */
    public static function CREATE($type)
    {
        return new self(collect((new self())->getEnums())->search($type));
    }

    /**
     * @return OauthGrantTypesEnum
     */
    public static function CLIENT_CREDENTIALS()
    {
        return new self(self::CLIENT_CREDENTIALS);
    }

    /**
     * @return OauthGrantTypesEnum
     */
    public static function REFRESH()
    {
        return new self(self::REFRESH);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.12.2019
 * Time: 0:41
 */

namespace App\Components\EmailDrivers;

use App\Objects\SendEmailsRequestObject;

interface EmailDriverInterface
{
    /**
     * @param SendEmailsRequestObject $emailsRequest
     */
    public function send(SendEmailsRequestObject $emailsRequest);
}

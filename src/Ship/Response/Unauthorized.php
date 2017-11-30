<?php
namespace App\Ship\Response;

use Zend\Diactoros\Response\TextResponse;

class Unauthorized extends TextResponse
{
    public function __construct()
    {
        parent::__construct('You not authorized to access this resource!', 401, []);
    }
}

<?php
namespace App\Ship\Helpers;

trait HashBytes
{
    /**
     * @return string
     */
    private function randomByte() : string
    {
        return bin2hex(random_bytes(25));
    }
}

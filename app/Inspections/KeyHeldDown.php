<?php

namespace App\Inspections;

use Exception;
use App\Inspections\Spam;

class KeyHeldDown extends Spam
{
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new \Exception('Your reply contains spam.');
        }
    }
}

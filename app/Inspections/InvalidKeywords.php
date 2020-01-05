<?php

namespace App\Inspections;

use Exception;
use App\Inspections\Spam;

class InvalidKeywords extends Spam
{
    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }
}

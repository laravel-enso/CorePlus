<?php

namespace LaravelEnso\CorePlus\app\Enums;

use LaravelEnso\Helpers\Classes\AbstractEnum;

class IsIndividualEnum extends AbstractEnum
{
    public function __construct()
    {
        $this->data = [

            1 => __('Yes'),
            0 => __('No'),
        ];
    }
}

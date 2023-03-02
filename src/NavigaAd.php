<?php

namespace NavigaAdClient;

use Illuminate\Support\Facades\Facade;

class NavigaAd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'naviga_ad';
    }
}

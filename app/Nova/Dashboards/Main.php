<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;
use MPhpMaster\CacheCard\CacheCard;

/**
 *
 */
class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            // new Help,
            CacheCard::make(),
        ];
    }

    public function uriKey()
    {
        return snake_case(class_basename(static::class), "-");
    }

    public function name()
    {
        return __('Main');
    }
}

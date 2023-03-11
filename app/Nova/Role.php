<?php

namespace App\Nova;

use App\Models\Role as MODEL;
use App\Traits\TRoleResource;

/**
 *
 */
class Role extends Resource
{
    use TRoleResource;

    public static int $priority = 1;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'User Management';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = MODEL::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Indicates if the resource should be globally searchable.
     *
     * @var bool
     */
    public static $globallySearchable = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    // public static $displayInNavigation = false;

    public function subtitle(): int|string|null
    {
        return null;
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('nova-spatie-permissions::lang.Roles');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('nova-spatie-permissions::lang.Role');
    }

    /**
     * @return bool
     */
    public static function isDisplayInNavigation(): bool
    {
        return isSuperAdmin() || isAdmin() || self::$displayInNavigation;
    }
}

<?php

namespace App\Models\Abstracts;

use App\Traits\THasImage;
use App\Traits\THasRoles;
use App\Traits\TModelTranslation;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * @mixin IdeHelperUserAbstract
 */
class UserAbstract extends \App\Models\Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    \Illuminate\Contracts\Auth\MustVerifyEmail,
    HasLocalePreference
{
    use \Laravel\Nova\Auth\Impersonatable;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use TModelTranslation;
    use THasRoles;
    use THasImage;
    use \App\Traits\THasPermissionGroup;

    /**
     * @param $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes[ 'password' ] = \Hash::needsRehash($value) ? \Hash::make($value) : $value;
    }

    /**
     * Get the preferred locale of the entity.
     *
     * @return string|null
     */
    public function preferredLocale()
    {
        return currentLocale();
    }
}

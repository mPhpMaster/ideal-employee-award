<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Model;

/**
 * @mixin \App\Policies\Abstracts\BasePolicy
 */
trait TDenyEditAttachedUser
{
    /**
     * Hides the edit relation button
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Model  $role
     * @param \App\Models\User $moodel
     *
     * @return bool
     */
    public function attachUser(User $user, Model $role, User $moodel)
    {
        return $this->canAttach($user, $role, $moodel);
    }
}

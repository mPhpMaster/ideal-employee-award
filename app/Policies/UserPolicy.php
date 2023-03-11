<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Abstracts\BasePolicy;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class UserPolicy extends BasePolicy
{
    // allow only to update my user
    // public function update(User $user, Model $model)
    // {
    //     if( $user->id === $model->id )
    //     {
    //         return true;
    //     }
    //
    //     return parent::update($user, $model);
    // }

    /**
     * @param \App\Models\User                    $user
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return false
     */
    // public function restore(User $user, Model $model)
    // {
    //     return false;
    // }

    /**
     * @param \App\Models\User                    $user
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return false
     */
    // public function forceDelete(User $user, Model $model)
    // {
    //     return false;
    // }
}

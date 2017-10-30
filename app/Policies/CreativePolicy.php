<?php

namespace App\Policies;

use App\User;
use App\Creative;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreativePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the creative.
     *
     * @param  \App\User  $user
     * @param  \App\Creative  $creative
     * @return mixed
     */
    public function view(User $user, Creative $creative)
    {
        //
    }

    /**
     * Determine whether the user can create creatives.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the creative.
     *
     * @param  \App\User  $user
     * @param  \App\Creative  $creative
     * @return mixed
     */
    public function update(User $user, Creative $creative)
    {
        //
    }

    /**
     * Determine whether the user can delete the creative.
     *
     * @param  \App\User  $user
     * @param  \App\Creative  $creative
     * @return mixed
     */
    public function delete(User $user, Creative $creative)
    {
        //
    }
}

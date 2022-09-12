<?php

namespace App\Policies;

use App\Site;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given site can be show for the user.
     *
     * @param \App\User $user
     * @param \App\Site $site
     * @return bool
     */
    public function view(?User $user, Site $site)
    {
        if ($user->isAdmin()) {
            return true;
        }
        if ($user->id == $site->user->id) {
            return true;
        }
        return null;
    }
}

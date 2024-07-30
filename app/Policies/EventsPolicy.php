<?php

namespace App\Policies;

use App\Models\Events;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class EventsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Events $events): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        if($user->role_id === 1){
            return true;
        }
        // if(Auth::user()->role_id === 1){
        //     return true;
        // }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Events $events): bool
    {
        if($user->id === $events->user_id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Events $events): bool
    {
        if($user->id === $events->user_id){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Events $events): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Events $events): bool
    {
        return false;
    }
}

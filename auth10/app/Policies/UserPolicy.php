<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the user can view the admin dashboard.
     */
    public function viewAdminDashboard(User $user)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Determine if the user can manage other users.
     */
    public function manageUsers(User $user)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Determine if the user can update the model.
     */
    public function update(User $user, User $model)
    {
        return $user->user_type === 'admin';
    }

    /**
     * Determine if the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
        // Prevent admin from deleting themselves
        if ($user->id === $model->id) {
            return false;
        }
        return $user->user_type === 'admin';
    }
}
<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    /**
     * Determine if the user can view the customer.
     */
    public function view(User $user, Customer $customer): bool
    {
        // user_id = 1 can view all
        if ($user->id === 1) {
            return true;
        }

        // others can only view their own
        return $customer->user_id === $user->id;
    }

    /**
     * Determine if the user can view any customer (for index).
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users can view index (filtered later)
        return true;
    }

    /**
     * Optional: allow update/delete
     */
    public function update(User $user, Customer $customer): bool
    {
        return $user->id === 1 || $customer->user_id === $user->id;
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->id === 1 || $customer->user_id === $user->id;
    }
}

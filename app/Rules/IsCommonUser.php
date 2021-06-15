<?php

namespace App\Rules;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class IsCommonUser implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  User  $user
     * @return bool
     */
    public function passes($attribute, $user)
    {
        return $user->user_type_id === UserRepository::COMMON_USER;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lojistas só recebem transferências, você não está qualificado para concluir esta operação.';
    }
}

<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Constants implementation.
     *
     * @var COMMON_USER
     * @var SHOPKEEPER_USER
     */
    const COMMON_USER = 1;
    const SHOPKEEPER_USER = 2;

    /**
     * The model implementation.
     *
     * @var model
     */
    private $user;

    /**
     * Create a new user model instance.
     *
     * @param User $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->user = $model;
    }

    /**
     * Get the user by id
     *
     * @return User $user
     */
    public function getById(int $id)
    {
        return $this->user
            ->where('id', $id)
            ->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return \App\Models\User $user
     */
    public function create(array $data)
    {
        DB::beginTransaction();

        $user = $this->user->create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'cpf_cnpj'      => $data['cpf_cnpj'],
            'password'      => bcrypt($data['password']),
            'wallet'        => 0,
            'user_type_id'  => $data['user_type_id']
        ]);

        DB::commit();

        return $user;
    }
}

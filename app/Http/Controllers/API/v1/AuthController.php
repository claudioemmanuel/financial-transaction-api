<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * The user repository implementation.
     *
     * @var userRepository
     */
    private $userRepository;

    /**
     * Create a new user repository instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {

            // Return valid response
            return response([
                'data'  => new UserResource(
                    $this->userRepository->create(
                        $request->all()
                    )
                )
            ], Response::HTTP_OK);
        } catch (\Exception $e) {

            // Return error response
            return response([
                'message'   => [
                    'file'  => $e->getFile(),
                    'line'  => $e->getLine(),
                    'description'   => $e->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Login user and create token
     *
     * @param string $email
     * @param string $password
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {

            $credentials = $request->only('email', 'password');

            // Attempt to login in API
            if (!Auth::attempt($credentials, false)) {
                return response([
                    'message' => 'Credenciais inválidas, favor verificar'
                ], Response::HTTP_UNAUTHORIZED);
            }

            /** @var User $user */
            $user = Auth::user();

            // Create a token
            $accessToken = $user->createToken('authToken')->accessToken;

            // Return valid response
            return response(
                [
                    'data' => [
                        'user'  => Auth::user(),
                        'authorization' => $accessToken
                    ]
                ],
                Response::HTTP_OK
            )
                ->header('Authorization', $accessToken);
        } catch (\Exception $e) {

            // Return error response
            return response([
                'message'   => [
                    'file'  => $e->getFile(),
                    'line'  => $e->getLine(),
                    'description'   => $e->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

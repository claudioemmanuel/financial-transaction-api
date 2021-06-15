<?php

namespace App\Http\Middleware;

use App\Http\Requests\UserTransactionRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Validate the logged in user
        $validation = new UserTransactionRequest();

        Validator::make(
            ["user" => $user],
            $validation->rules(),
            $validation->messages()
        )->validate();

        // Check if the value sent is greater than what is available
        if ($user->wallet < $request->value) {
            return response([
                'message'   => 'Valor enviado acima do saldo disponível, favor verificar.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $next($request);
    }
}

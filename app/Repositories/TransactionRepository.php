<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\HttpClient;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * The model implementation.
     *
     * @var Transaction $transaction
     * @var User $user
     */
    private $transaction;
    private $userRepository;
    private $httpClient;

    /**
     * Create a new transaction and user model instance.
     *
     * @param Transaction $model
     * @param UserRepositoryInterface $userRepository
     * @param httpClient $service
     *
     * @return void
     */
    public function __construct(
        Transaction $transaction,
        UserRepositoryInterface $userRepository,
        HttpClient $httpClient
    ) {
        $this->transaction = $transaction;
        $this->userRepository = $userRepository;
        $this->httpClient = $httpClient;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return \App\Models\Transaction $transaction
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            /** @var User $payer */
            $payer = Auth::user();

            $transaction = $this->transaction->create([
                'user_id'   => $payer->id,
                'payee_id'  => $data['payee'],
                'value'     => $data['value']
            ]);

            if (!$transaction) {
                throw new Exception("Transação não cadastrada.");
            }

            // Find payee user
            $payee = $this->userRepository->getById($data['payee']);

            // Debit value
            $payer->update([
                'wallet' => $payer->wallet - $transaction->value
            ]);

            // Credit value
            $payee->update([
                'wallet' => $payee->wallet + $transaction->value
            ]);

            return $this->checkTransactionAvaliable($transaction);
        });
    }

    /**
     * Checks if transaction has been authorized and sends notification.
     *
     * @param array $transaction
     * @return \App\Models\Transaction $transaction
     */
    private function checkTransactionAvaliable($transaction)
    {
        // Check if the transaction is authorized
        if ($this->httpClient->authorizeTransaction($transaction)) {

            // Send notification
            $this->httpClient->paymentReceivedNotification();

            return $transaction;
        }

        throw new Exception("Transação não autorizada.");
    }
}

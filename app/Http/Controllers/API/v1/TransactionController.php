<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * The transaction repository implementation.
     *
     * @var transactionRepository
     */
    private $transactionRepository;

    /**
     * Create a new transaction repository instance.
     *
     * @param TransactionRepositoryInterface $transactionRepository
     * @return void
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transaction(TransactionRequest $request)
    {
        try {

            // Return valid response
            return response([
                'data'  => new TransactionResource(
                    $this->transactionRepository->create(
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
}

<?php

namespace App\Api\V1\Jobs;

use App\Api\V1\Exceptions\BusinessException;
use App\Api\V1\Exceptions\NotEnoughProductException;
use App\Api\V1\Exceptions\UserNotEnoughBalanceException;
use App\Api\V1\Repositories\Interfaces\OperationRepositoryInterface;
use App\Api\V1\Services\Interfaces\OperationServiceInterface;
use App\Api\V1\Services\Interfaces\ProductServiceInterface;
use App\Api\V1\Services\Interfaces\UserBalanceServiceInterface;
use App\Constants\OperationStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessOperation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $statusByException = [
        UserNotEnoughBalanceException::class => OperationStatus::NOT_ENOUGH_BALANCE,
        NotEnoughProductException::class => OperationStatus::NOT_ENOUGH_PRODUCT
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private int $operationId
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        OperationRepositoryInterface $operationRepository,
        OperationServiceInterface    $operationService,
        UserBalanceServiceInterface  $userBalanceService,
        ProductServiceInterface      $productService,
    )
    {
        $operation = $operationRepository->byId(id: $this->operationId);

        try {
            DB::beginTransaction();

            $operationService->checkUserBalanceForProduct(user: $operation->user, product: $operation->product);

            $operationService->hasProductForUser(product: $operation->product);

            $userBalanceService->sub(user: $operation->user, sum: $operation->price);

            $productService->subBalance(product: $operation->product, count: 1);

            $operationService->changeStatus(operation: $operation, status: OperationStatus::PROCESSED);

            DB::commit();

        } catch (BusinessException $exception) {

            DB::rollBack();

            $status = $this->statusByException[get_class($exception)];

            $operationService->changeStatus(operation: $operation, status: $status);

        }
    }
}

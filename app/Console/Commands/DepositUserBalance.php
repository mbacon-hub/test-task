<?php

namespace App\Console\Commands;

use App\Api\V1\Repositories\Interfaces\UserRepositoryInterface;
use App\Api\V1\Services\Interfaces\UserBalanceServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class DepositUserBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance:deposit {email} {sum}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deposit user\'s balance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UserRepositoryInterface $userRepository, UserBalanceServiceInterface $depositBalanceService)
    {
        try {
            $data = $this->validateArguments([
                "email" => $this->argument("email"),
                "sum" => $this->argument("sum")
            ]);

            $user = $userRepository->byEmail(email: $data->get("email"));

            $depositBalanceService->add(user: $user, sum: $data->get("sum"));

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }

    private function validateArguments(array $data): Collection
    {
        $validator = Validator::make($data, [
            "email" => ["required", "email", "exists:users,email"],
            "sum" => ["required", "numeric", "min:1"]
        ]);

        return collect($validator->validated());
    }
}

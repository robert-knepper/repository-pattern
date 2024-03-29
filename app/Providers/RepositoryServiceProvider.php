<?php

namespace App\Providers;

use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    private function repositories(): array
    {
        return [
            UserRepositoryInterface::class => UserRepository::class
        ];
    }

    public function register()
    {
        // register interface with repository
        foreach ($this->repositories() as $interface => $repository)
            $this->app->bind($interface, $repository);
    }

    public function boot()
    {
        //
    }
}

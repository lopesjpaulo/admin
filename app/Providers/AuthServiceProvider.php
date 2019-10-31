<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Permission;
use App\Models\Question;
use App\Policies\NewsPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        News::class => NewsPolicy::class,
        User::class => UserPolicy::class,
        Question::class => QuestionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::with(['roles'])->get();

        foreach($permissions as $permission){
            Gate::define($permission->title, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}

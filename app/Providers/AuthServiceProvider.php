<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{Users, UsersUpdate};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $users;

    public $level;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        $level = [
            'Admin' => 1,
            'Users' => 2,
            'CS' => 3,
        ];
    
        /*!--------!*/ 
        /*! Users !*/ 
        /*!--------!*/ 

        /* Created Users */
        Gate::define('created-users', function($users) use ($level) {
            unset($level['Users']);
            unset($level['CS']);

            return in_array($users->level_id, $level);
        });

        /*!--------!*/ 
        /*! ROLE !*/ 
        /*!--------!*/ 
        
        /* Chose Patner Find A Patner */
        Gate::define('find_a_patner', function($users) {
            return $users->choose_patner == 'find_a_patner';
        });

        /* Access Admin */
        Gate::define('not_allowed_users', function($users) use($level) {
            unset(
                $level['Users'],
                $level['CS'],
            );

            return in_array($users->level_id, $level);
        });
    }
}

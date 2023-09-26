<?php


namespace App\Providers;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; // Import the Route facade

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function ($user ,string $token) {
            $admin = Admin::where('email',$user->email)->first();
            if($admin){
                $url = "http://127.0.0.1:8000/admin/password/reset/".$token."?email=".$user->email;
            }else{
                $url = "http://127.0.0.1:8000/password/reset/".$token."?email=".$user->email;
            }
            return $url;
        });
    
    }
}

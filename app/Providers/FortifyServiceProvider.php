<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();
        if($request->is('doctor/*')){
            Config::set('fortify.guard','doctor');
            Config::set('fortify.password','doctors');
            Config::set('fortify.prefix','doctor');
            Config::set('fortify.home','/doctor/home');
        }
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                if(Config::get('fortify.guard') == 'doctor'){
                    return redirect()->intended('/doctor/home');
                }
                return redirect('/');
            }
        });
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                if(Config::get('fortify.guard') == 'doctor'){
                    return redirect('/doctor/login');
                }
                return redirect('/');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });
        Fortify::authenticateUsing(function (Request $request) {
            if(Config::get('fortify.guard') == 'doctor'){
                $user = Doctor::where('username', $request->username)->first();
                if ($user &&
                    Hash::check($request->password, $user->password)) {
                    return $user;
                }
            }
            if(Config::get('fortify.guard') == 'web'){
                $user = User::where('username', $request->username)->first();
                if ($user &&
                    Hash::check($request->password, $user->password)) {
                    return $user;
                }
            }
        });
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}

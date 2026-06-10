<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\VerifyEmailResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {

              public function toResponse($request)
              {
                $user = auth()->user();

                // 初回ログイン判定
                if (
                    empty($user->postal_code) ||
                    empty($user->address)
                ) {
                    return redirect('/mypage/profile');
                }

                // 通常ログイン
                return redirect('/');
              }
            };
        });

        $this->app->singleton(RegisterResponse::class, function () {
            return new class implements RegisterResponse {

               public function toResponse($request)
              {
                return redirect('/mypage/profile');
              }
           };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);
        Fortify::verifyEmailView(function () {
        return view('auth.verify');
        });

        $this->app->instance(VerifyEmailResponse::class, new class implements VerifyEmailResponse {
           public function toResponse($request)
            {
              return redirect('/mypage/profile');
            }
        });
        
        Fortify::loginView(function () {
        return view('auth.login');
        });
        Fortify::registerView(function () {
        return view('auth.register');
        });
        
        Fortify::authenticateUsing(function (Request $request) {

            $loginRequest = new LoginRequest();

            $validated = validator(
                $request->all(),
                $loginRequest->rules(),
                $loginRequest->messages()
            )->validate();

           if (!Auth::attempt($request->only('email', 'password'))) {

               throw ValidationException::withMessages([
                  'email' => ['ログイン情報が登録されていません'],
               ]);
            }

           return Auth::user();
       });

        Fortify::redirects('register', '/mypage/profile');
        Fortify::redirects('login', '/');

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}

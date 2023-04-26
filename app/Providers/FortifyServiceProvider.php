<?php

namespace App\Providers;

use App\Models\ClassRoom;
use App\Models\Competency;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;
use RealRashid\SweetAlert\Facades\Alert;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                if (Auth::user()->role == 'Admin') {
                    Alert::success('Berhasil', 'Anda masuk sebagai admin');
                    return redirect()->route('admin-dashboard');
                } else {
                    Alert::success('Berhasil', 'Anda masuk sebagai anggota');
                    return redirect()->route('dashboard');
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::registerView(function () {

            $classrooms = ClassRoom::all();
            $competencies = Competency::all();

            return view('auth.register', [
                'classrooms' => $classrooms,
                'competencies' => $competencies
            ]);
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::verifyEmailView(function () {
            Alert::success('Berhasil', 'Anda telah terdaftar menjadi anggota');
            return view('auth.verify-email');
        });
    }
}

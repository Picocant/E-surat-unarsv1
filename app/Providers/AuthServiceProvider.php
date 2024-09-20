<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-system', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('change-account-role', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU
            ]);
        });

        Gate::define('change-account-position', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU
            ]);
        });

        Gate::define('read-position', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
                User::ROLE_STAF_TU,
            ]);
        });

        Gate::define('create-position', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-position', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-position', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('read-user', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
                User::ROLE_STAF_TU,
            ]);
        });

        Gate::define('create-user', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-user', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-user', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('read-incoming-letter-category', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('create-incoming-letter-category', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-incoming-letter-category', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-incoming-letter-category', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('read-incoming-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-incoming-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('update-incoming-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('delete-incoming-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('read-incoming-letter-disposition', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-incoming-letter-disposition', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('update-incoming-letter-disposition', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('delete-incoming-letter-disposition', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('read-student', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-student', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-student', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-student', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('read-active-student-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-active-student-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-active-student-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-active-student-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-active-student-letter-verification', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('read-student-certificate', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });


        Gate::define('create-student-certificate', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-student-certificate', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-student-certificate', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('read-school-document', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-school-document', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-school-document', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-school-document', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('read-pindah-prodi', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('read-school-transfer-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-school-transfer-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-school-transfer-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-school-transfer-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-school-transfer-letter-verification', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('read-sppd-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-sppd-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-sppd-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-sppd-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-sppd-letter-verification', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('read-leave-permit-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('create-leave-permit-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-leave-permit-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('delete-leave-permit-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('update-leave-permit-letter-verification', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
                User::ROLE_KEPALA_SEKOLAH,
            ]);
        });

        Gate::define('request-leave-permit-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_GURU,
            ]);
        });

        Gate::define('read-received-sppd-letter', function (User $user) {
            return in_array($user->role, [
                User::ROLE_GURU,
            ]);
        });

        // Report
        Gate::define('generate-incoming-letter-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-incoming-letter-disposition-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-active-student-letter-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-school-transfer-letter-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-sppd-letter-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-leave-permit-letter-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-school-document-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-student-certificate-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });

        Gate::define('generate-letter-statistic-report', function (User $user) {
            return in_array($user->role, [
                User::ROLE_KEPALA_TU,
            ]);
        });
    }
}

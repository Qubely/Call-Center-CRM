<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\IBaseRepository;
use Illuminate\Support\ServiceProvider;
//vpx_imports
use App\Repositories\Admin\Company\List\Crud\ICompanyCrudRepository;
use App\Repositories\Admin\Company\List\Crud\CompanyCrudRepository;
use App\Repositories\Admin\DataLibrary\TimeZone\Crud\ILibTimeZoneCrudRepository;
use App\Repositories\Admin\DataLibrary\TimeZone\Crud\LibTimeZoneCrudRepository;
use App\Repositories\Admin\DataLibrary\Country\Crud\ILibCountryCrudRepository;
use App\Repositories\Admin\DataLibrary\Country\Crud\LibCountryCrudRepository;
use App\Repositories\Admin\System\User\Policy\IAdminUserPolicyRepository;
use App\Repositories\Admin\System\User\Policy\AdminUserPolicyRepository;
use App\Repositories\Admin\System\User\UserRole\Crud\IAdminUserRoleCrudRepository;
use App\Repositories\Admin\System\User\UserRole\Crud\AdminUserRoleCrudRepository;
use App\Repositories\Admin\System\User\Crud\IAdminUserCrudRepository;
use App\Repositories\Admin\System\User\Crud\AdminUserCrudRepository;
class RepositoryServiceProvider extends ServiceProvider
{
        /**
         * Register any application services.
         */
        public function register(): void
        {
            $this->app->bind(abstract: IBaseRepository::class, concrete: BaseRepository::class);
            //vpx_attach
            $this->app->bind(abstract: ICompanyCrudRepository::class, concrete: CompanyCrudRepository::class);
            $this->app->bind(abstract: ILibTimeZoneCrudRepository::class, concrete: LibTimeZoneCrudRepository::class);
            $this->app->bind(abstract: ILibCountryCrudRepository::class, concrete: LibCountryCrudRepository::class);
            $this->app->bind(abstract: IAdminUserPolicyRepository::class, concrete: AdminUserPolicyRepository::class);
            $this->app->bind(abstract: IAdminUserRoleCrudRepository::class, concrete: AdminUserRoleCrudRepository::class);
            $this->app->bind(abstract: IAdminUserCrudRepository::class, concrete: AdminUserCrudRepository::class);
        }
}

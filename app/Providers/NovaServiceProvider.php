<?php

namespace App\Providers;

use App\Nova\Application;
use App\Nova\Award;
use App\Nova\Dashboards\Main;
use App\Nova\DirectBoss;
use App\Nova\Employee;
use App\Nova\Position;
use App\Nova\SupervisorCommittee;
use App\Nova\TechnicalCommittee;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

/**
 *
 */
class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Nova::withBreadcrumbs();
        // Nova::withoutThemeSwitcher();
        Nova::serving(function(ServingNova $event) {
            Nova::translations(lang_path("vendor/nova/" . currentLocale() . ".json"));
        });

        // loading custom files
        Nova::serving(function(ServingNova $event) {
            Nova::script('js-helpers', resource_path("js/helpers.js"));
        });

        static::bootMenu($this);
        static::bootUserMenu($this);
        static::bootFooter($this);

        // Nova::enableRTL();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function($user) {
            return isDeveloperMode() || in_array($user->email, [
                    'admin@app.com',
                    'admin@admin.com',
                ]) || $user->isAnyAdmin();
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Badinansoft\LanguageSwitch\LanguageSwitch(),

            new \Visanduma\NovaBackNavigation\NovaBackNavigation(),

            \Packages\NovaPermissions\NovaPermissions::make(),

            // \Sereny\NovaPermissions\NovaPermissions::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::enableRTL(fn() => currentLocale() === 'ar');
        Nova::withBreadcrumbs(fn() => auth()->check());
        Nova::sortResourcesBy(function($resource) {
            return $resource::$priority ?? 9999;
        });
    }

    public static function bootMenu(?ServiceProvider $provider = null)
    {
        if( $provider->app->getLocale() === 'ar' ) {
            Nova::enableRTL();
        }

        Nova::mainMenu(fn(Request $request) => [
            MenuSection::dashboard(Main::class)->icon('chip'),
            // MenuSection::dashboard(Main::class)->icon('chart-bar'),
            MenuSection::resource(Application::class)->icon('book-open'),

            MenuSection::make(
                __('Award Management'),
                [
                    MenuItem::resource(Award::class),
                    MenuItem::resource(Position::class),
                ]
            )->icon('star')->collapsable(),

            MenuSection::make(
                __('User Management'),
                [
                    MenuItem::resource(User::class),
                    MenuItem::resource(DirectBoss::class),
                    MenuItem::resource(Employee::class),
                    MenuItem::resource(SupervisorCommittee::class),
                    MenuItem::resource(TechnicalCommittee::class),
                    MenuItem::link(__('nova-spatie-permissions::lang.sidebar_label_roles'), 'resources/roles'),
                    MenuItem::link(__('nova-spatie-permissions::lang.sidebar_label_permissions'), 'resources/permissions'),
                ]
            )->icon('users')->collapsable(),

        ]);
    }

    public static function bootUserMenu(?ServiceProvider $provider = null)
    {
        Nova::userMenu(function(Request $request, Menu $menu) {
            if( $request->user() ) {
                $menu->prepend(
                    MenuItem::make(
                        __('Profile'),
                        "/resources/users/{$request->user()->getKey()}/edit"
                    )
                );
            }

            return $menu;
        });
    }

    public static function bootFooter(?ServiceProvider $provider = null)
    {
        Nova::footer(function($request) {
            $devMode = "";
            if( isDeveloperMode() ) {
                $devMode = "<span class='text-green-600'>DevMode</span>";
                $devMode .= " <span class='text-primary-800'>(" . getDeveloper() . ")</span>";
            }
            $devMode = $devMode ? "{$devMode}" : "";

            $version = "";
            if( \File::exists($composerPath = base_path('composer.json')) ) {
                try {
                    $version = "<span class='text-xxs'> v";
                    $version .= data_get(json_decode(\File::get($composerPath), true) ?: [], "version");
                    $version .= "</span>";
                } catch(\Exception|\Error $exception) {
                }
            }
            $version = $devMode ? " - {$version}" : $version;

            return Blade::render("<div class='text-xxs'>@env('local') {$devMode} @endenv {$version}</div>");
        });

        // \Laravel\Nova\Nova::footer(function($request) {
        //     return Blade::render(
        //         '
        //     @env(\'local\')
        //         This is Local!
        //     @endenv
        //     @env(\'prod\')
        //         This is Production!
        //     @endenv
        // '
        //     );
        // });
    }
}

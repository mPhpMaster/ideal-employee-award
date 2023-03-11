<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Gate::after(fn($user, $ability) => $user->isAnyAdmin());

        \Illuminate\Database\Eloquent\Builder::macro('getSql', function(bool $parse = false) {
            return getSql(
                $this->getModel()->exists ? modelToQuery($this->getModel()) : $this,
                $parse
            );
        });

        /**
         * Paginate a standard Laravel Collection.
         *
         * @mixins Collection
         *
         * @param int|null $perPage
         * @param array    $only
         * @param string   $pageName
         * @param int|null $page
         * @param int|null $total
         * @param string   $pageName
         *
         * @return \Illuminate\Pagination\LengthAwarePaginator
         */
        Collection::macro('paginate', function($perPage = null, array $only = [ '*' ], $pageName = 'page', $page = null, ?int $total = null): LengthAwarePaginator {
            /** @type Collection $this */
            $only = Collection::make($only)->filter(fn($i) => $i && $i !== '*')->toArray();
            $self = count($only) ? $this->only($only) : $this;
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $self->forPage($page, $perPage),
                $total ?: $self->count(),
                $perPage ?: 15,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        Collection::macro('mergeIfMissing', function(string|\Closure|array $key, mixed $value = null): Collection {
            /** @type Collection $this */
            $key = value($key);
            throw_if(is_array($key) && !is_null($value), "\$key can not be array!");

            $data = is_array($key) ? $key : [ $key => $value ];
            foreach( $data as $key => $value ) {
                $this->getOrPut($key, $value);
            }

            return $this;
        });

        \Schema::defaultStringLength(125);
    }
}

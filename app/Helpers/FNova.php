<?php

use Laravel\Nova\Fields\Select;

if( !function_exists('NovaStatusField') ) {
    /**
     * @param array $options
     *
     * @return \Laravel\Nova\Fields\Select
     */
    function NovaStatusField(
        array $config = [
            'name' => null,
            'attribute' => null,
            'trans' => null,
            'options' => null,
            'default' => STATUS_ACTIVE,
        ]
    ): Select {
        [
            'name' => $name,
            'attribute' => $attribute,
            'trans' => $trans,
            'options' => $options,
            'default' => $default,
        ] = $config;

        /** @var string $attribute */
        $attribute = value($attribute ?: $name);

        /** @var \Closure $trans */
        $trans = !$trans && !isClosure($trans) && !is_callable($trans) ? (fn(...$a) => $a[ 0 ] ?? null) : $trans;

        $options = $options ?: $trans(str_plural(snake_case($attribute)));
        /** @var array $options */
        $options = array_wrap(is_string($options) ? $trans($options) : $options);

        /** @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest):mixed)|mixed $default */
        $default = value($default) ?: STATUS_ACTIVE;

        return Select::make($trans($name), $attribute)
                     ->options(fn() => $options)
                     ->default(fn() =>$default)
                     ->sortable()
                     ->displayUsingLabels();
    }
}

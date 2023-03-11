<?php
if (!function_exists('currentLocale')) {
    /**
     * return appLocale
     *
     * @param bool $full
     *
     * @return string
     */
    function currentLocale($full = false): string
    {
        if ($full)
            return (string)app()->getLocale();

        $locale = str_replace('_', '-', app()->getLocale());
        $locale = current(explode("-", $locale));

        return $locale ?: "";
    }
}

if (!function_exists('setCurrentLocale')) {
    /**
     * @param \Closure|string|null $locale
     *
     * @return bool
     */
    function setCurrentLocale($locale = null): bool
    {
        try {
            $session = request()->session();
        } catch (Exception|Error $error) {
            try {
                $session = resolve('session');
                request()->setLaravelSession($session);
            } catch (Exception $exception) {
                $session = optional();
            }
        }
        $language = value($locale);
        $language ??= $session->get('language') ?: getDefaultLocale('en');

        if ($language && isLocaleAllowed($language)) {
            if (currentLocale() !== $language) {
                $session->put('language', $language);
                $session->save();

                app()->setLocale($language);
            }

            return true;
        }

        return false;
    }
}

if (!function_exists('getDefaultLocale')) {
    /**
     * @param string|\Closure $default
     *
     * @return string|null
     */
    function getDefaultLocale($default = 'en'): string|null
    {
        $default = value($default);

        return config('app.locale', config('app.fallback_locale', $default)) ?: $default;
    }
}

if (!function_exists('isLocaleAllowed')) {
    /**
     * @param string|\Closure $locale
     *
     * @return bool
     */
    function isLocaleAllowed($locale): bool
    {
        return array_key_exists($locale, array_flip(getLocales(true)));
    }
}

if (!function_exists('getLocales')) {
    /**
     * @return array
     */
    function getLocales(bool $withNames = false): array
    {
        $locales = config('app.locales', []);

        return $withNames ? array_flip($locales) : array_keys($locales);
    }
}

if( !function_exists('getTrans') ) {
    /**
     * Translate the given message or return default.
     *
     * @param string|null $key
     * @param array       $replace
     * @param string|null $locale
     *
     * @return string|array|null
     */
    function getTrans($key = null, $default = null, $replace = [], $locale = null)
    {
        $key = value($key);
        $return = __($key, $replace, $locale);

        return $return === $key ? value($default) : $return;
    }
}

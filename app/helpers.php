<?php

if (! function_exists('localized_route')) {
    /**
     * Generate a localized URL for the given route.
     *
     * @param  string  $name
     * @param  array  $parameters
     * @param  string|null  $locale
     * @return string
     */
    function localized_route($name, $parameters = [], $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return route($name, array_merge(['locale' => $locale], $parameters));
    }
}

if (! function_exists('current_locale')) {
    /**
     * Get the current locale.
     *
     * @return string
     */
    function current_locale()
    {
        return app()->getLocale();
    }
}

if (! function_exists('switch_locale_url')) {
    /**
     * Generate URL for switching to a different locale while keeping the current route.
     *
     * @param  string  $locale
     * @return string
     */
    function switch_locale_url($locale)
    {
        $currentRouteName = request()->route()->getName();
        $currentParams = request()->route()->parameters();

        // Remove locale from current parameters
        unset($currentParams['locale']);

        // Add new locale
        $currentParams['locale'] = $locale;

        // Also preserve query parameters
        $queryParams = request()->query();

        return route($currentRouteName, array_merge($currentParams, $queryParams));
    }
}

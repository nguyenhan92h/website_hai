<?php

/*
|--------------------------------------------------------------------------
| Replication official function
|--------------------------------------------------------------------------
|
| Official library path
| Illuminate/Support/helpers.php
|
*/

if (! function_exists('route')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string  $route
     * @param  string  $parameters
     * @return string
     */
    function route($route, $parameters = array())
    {
        if (Route::getRoutes()->hasNamedRoute($route))
            return app('url')->route($route, $parameters);
        else
            return 'javascript:void(0)';
    }
}

if (! function_exists('link_to_route')) {
    /**
     * Generate a HTML link to a named route.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function link_to_route($name, $title = null, $parameters = array(), $attributes = array())
    {
        if (Route::getRoutes()->hasNamedRoute($name))
            return app('html')->linkRoute($name, $title, $parameters, $attributes);
        else
            return '<a href="javascript:void(0)"'.HTML::attributes($attributes).'>'.$name.'</a>';
    }
}


/*
|--------------------------------------------------------------------------
| Extending from the expansion of the configuration file
|--------------------------------------------------------------------------
|
*/

if (! function_exists('style')) {
    /**
     * Style Alias load (support bulk loading, the latter can expand to automatically merge multiple files compressed)
     * @param  dynamic  mixed  Profile aliases
     * @return string
     */
    function style()
    {
        $cssAliases = Config::get('extend.cssAliases');
        $styleArray = array_map(function ($aliases) use ($cssAliases) {
            if (isset($cssAliases[$aliases]))
                return HTML::style($cssAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($styleArray));
    }
}

if (! function_exists('script')) {
    /**
     * Load script alias (support bulk loading, the latter can expand automatically merge multiple files compressed)
     * @param  dynamic  mixed  Profile aliases
     * @return string
     */
    function script()
    {
        $jsAliases   = Config::get('extend.jsAliases');
        $scriptArray = array_map(function ($aliases) use ($jsAliases) {
            if (isset($jsAliases[$aliases]))
                return HTML::script($jsAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($scriptArray));
    }
}


/*
|--------------------------------------------------------------------------
| Custom Kernel
|--------------------------------------------------------------------------
|
*/

if (! function_exists('define_array')) {
    /**
     * Batch define constants
     * @param  array  $define Array constants and values
     * @return void
     */
    function define_array($define = array())
    {
        foreach ($define as $key => $value)
            defined($key) OR define($key, $value);
    }
}

if (! function_exists('friendly_date')) {
    /**
     * Friendly Date output
     * @param  string|\Carbon\Carbon $theDate Time string pending | \ Carbon \ Carbon instance
     * @return string                         Friendly time string
     */
    function friendly_date($theDate)
    {
        // Get a Date object to be processed
        if (! $theDate instanceof \Carbon\Carbon)
            $theDate = \Carbon\Carbon::createFromTimestamp(strtotime($theDate));
        // Made English Date Description
        $friendlyDateString = $theDate->diffForHumans(\Carbon\Carbon::now());
        // Localization
        $friendlyDateArray  = explode(' ', $friendlyDateString);
        $friendlyDateString = $friendlyDateArray[0]
            .Lang::get('friendlyDate.'.$friendlyDateArray[1])
            .Lang::get('friendlyDate.'.$friendlyDateArray[2]);
        // Data is returned
        return $friendlyDateString;
    }
}

if (! function_exists('pagination')) {
    /**
     * Paging expand output, support for temporary specify paging template
     * @param  Illuminate\Pagination\Paginator $paginator Final results of the query page examples
     * @param  string                          $viewName  Page View Name
     * @return \Illuminate\View\View
     */
    function pagination(Illuminate\Pagination\Paginator $paginator, $viewName = null)
    {
        $viewName = $viewName ?: Config::get('view.pagination');
        $paginator->getEnvironment()->setViewName($viewName);
        return $paginator->links();
    }
}

if (! function_exists('strip')) {
    /**
     * Dereference a string through e (htmlentities) and addslashes processing
     * @param  string $string The string to be processed
     * @return After escaping a string
     */
    function strip($string)
    {
        return stripslashes(HTML::decode($string));
    }
}


/*
|--------------------------------------------------------------------------
| Public libraries
|--------------------------------------------------------------------------
|
*/

if (! function_exists('close_tags')) {
    /**
     * Closing HTML tag (this function is still flawed, unable to deal with incomplete labeling, no better plan, with caution)
     * @param  string $html HTML String
     * @return string
     */
    function close_tags($html)
    {
        // Does not require completion of the label
        $singleTags = array('meta', 'img', 'br', 'link', 'area');
        // Match start tag
        preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedTags = array_filter(array_reverse($result[1]), function ($tag) use ($singleTags) {
            if (! in_array($tag, $singleTags)) return $tag;
        });
        // Matching closing tag
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedTags = $result[1];
        // Begin completion
        foreach ($openedTags as $value) {
            if (in_array($value, $closedTags)) {
                unset($closedTags[array_search($value, $closedTags)]);
            } else {
                $html .= '</'.$value.'>';
            }
        }
        return $html;
    }
}

if (! function_exists('order_by')) {
    /**
     * Label resource list for sorting
     *param String $ columnName column names
      *param String $ default if the default sort column, up down Default Default Ascending Descending
      *return String a label sort icon
      */
    function order_by($columnName = '', $default = null)
    {
        $sortColumnName = Input::get('sort_up', Input::get('sort_down', false));
        if (Input::get('sort_up')) {
            $except = 'sort_up'; $orderType = 'sort_down';
        } else {
            $except = 'sort_down' ; $orderType = 'sort_up';
        }
        if ($sortColumnName == $columnName) {
            $parameters = array_merge(Input::except($except), array($orderType => $columnName));
            $icon       = Input::get('sort_up') ? 'chevron-up' : 'chevron-down' ;
        } elseif ($sortColumnName === false && $default == 'asc') {
            $parameters = array_merge(Input::all(), array('sort_down' => $columnName));
            $icon       = 'chevron-up';
        } elseif ($sortColumnName === false && $default == 'desc') {
            $parameters = array_merge(Input::all(), array('sort_up' => $columnName));
            $icon       = 'chevron-down';
        } else {
            $parameters = array_merge(Input::except($except), array('sort_up' => $columnName));
            $icon       = 'random';
        }
        $a  = '<a href="';
        $a .= action(Route::current()->getActionName(), $parameters);
        $a .= '" class="glyphicon glyphicon-'.$icon.'"></a>';
        return $a;
    }
}

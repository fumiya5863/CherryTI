<?php

/*
|--------------------------------------------------------------------------
| Class that processes the request received from user
|--------------------------------------------------------------------------
*/

class _Route{

    /**
     * Processing that received the get request
     *
     * @param string $_match_rule
     * @param string $_class_name
     * @param string $_method_name
     * @return void
     */
    public static function _get(string $_match_rule, string $_class_name, string $_method_name){
        if (!IS_GET) {
            return;
        }
        return _Route::_common_run($_match_rule, $_class_name, $_method_name);
    }

    /**
     * Processing that received the post request
     *
     * @param string $_match_rule
     * @param string $_class_name
     * @param string $_method_name
     * @return void
     */
    public static function _post(string $_match_rule, string $_class_name, string $_method_name){
        if (!IS_POST) {
            return;
        }
        return _Route::_common_run($_match_rule, $_class_name, $_method_name);
    }

    /**
     * Request processing
     *
     * @param string $_match_rule
     * @param string $_class_name
     * @param string $_method_name
     * @return void
     */
    public static function _common_run(string $_match_rule, string $_class_name, string $_method_name){
        $_url_array = explode('/', $_match_rule);
        $_is_var_exists_rule = _Route::_is_var_exists_rule($_match_rule);
        $_var = null;

        if ($_is_var_exists_rule) {
            $_match_rule = _Route::_exclude_var_rule($_match_rule);
        }

        if (strpos(ROUTE_URI, $_match_rule) === false) {
            return;
        }

        if ($_is_var_exists_rule) {
            $_root_url_array = explode('/', ROUTE_URI);
            $_var = $_root_url_array[count($_root_url_array)-2];
        }
        
        _load_app_files(CONTROLLER_PATH, $_class_name);
        $app_class = new $_class_name();
        $app_class->$_method_name();
    }

    /**
     * Check if the {} parameter is included
     *
     * @param string $_match_rule
     * @return bool
     */
    public static function _is_var_exists_rule($_match_rule){
        return preg_match('/\/\{.*\}$/u', $_match_rule, $_result) === 1;
    }

    /**
     * Get the URL with the parameters
     *
     * @param string $_match_rule
     * @return string
     */
    public static function _exclude_var_rule($_match_rule){
        return preg_replace('/\{.*\}$/u', "", $_match_rule);
    }
}

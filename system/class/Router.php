<?php

/*
|--------------------------------------------------------------------------
| Class that processes the request received from user
|--------------------------------------------------------------------------
*/

class _Router {

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
        
        return _Router::_common_run($_match_rule, $_class_name, $_method_name);
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
        return _Router::_common_run($_match_rule, $_class_name, $_method_name);
    }

    /**
     * Request processing
     *
     * @param string $_match_rule
     * @param string $_class_name
     * @param string $_method_name
     * @return void
     */
    private static function _common_run(string $_match_rule, string $_class_name, string $_method_name){
        
        $_is_var_exists_rule = _Router::_is_var_exists_rule($_match_rule);
        $_var = null;

        if ($_is_var_exists_rule) {
            $_match_rule = _Router::_exclude_var_rule($_match_rule);
        }

        if (!_Router::_is_match_url($_match_rule, $_is_var_exists_rule)) {
            return;
        }

        if ($_is_var_exists_rule) {
            $_root_url_array = explode('/', ROUTE_URI);
            $_var = $_root_url_array[count($_root_url_array)-1];
        }
        
        require_once(CONTROLLER_PATH . $_class_name . EXTENSION_PHP);
        $app_class = new $_class_name();
        $app_class->$_method_name($_var);
        exit;
    }

    /**
     * Check if the url matches
     *
     * @param string $_match_rule
     * @param string $_is_var_exists_rule
     * @return bool
     */
    private static function _is_match_url($_match_rule, $_is_var_exists_rule): bool
    {
        if ($_is_var_exists_rule) {
            $_url_array = explode("/", ROUTE_URI);
            $_is_match_url = (empty(ROUTE_URI) && $_match_rule === "/") || ROUTE_URI === trim($_match_rule, "/") . "/" . $_url_array[count($_url_array) - 1];
        } else {
            $_is_match_url = (empty(ROUTE_URI) && $_match_rule === "/") || ROUTE_URI === trim($_match_rule, "/");
        }

        if ($_is_match_url) {
            return true;
        }

        return false;
    }
    
    /**
     * Check if the {} parameter is included
     *
     * @param string $_match_rule
     * @return bool
     */
    private static function _is_var_exists_rule($_match_rule){
        return preg_match('/\/\{.*\}$/u', $_match_rule, $_result) === 1;
    }
    
    /**
     * Get the URL with the parameters
     *
     * @param string $_match_rule
     * @return string
     */
    private static function _exclude_var_rule($_match_rule){
        return preg_replace('/\{.*\}$/u', "", $_match_rule);
    }
}

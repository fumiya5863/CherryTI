<?php


/*
|--------------------------------------------------------------------------
| Loader class
|--------------------------------------------------------------------------
*/

class _Loader {

    public function __construct()
    {   
        $this->_load_env();
                
        $this->_load_system();

        $this->_load_error();
        
        $this->_load_app_route();

        $this->_load_not_route_display();
    }

    /**
     * 
     *
     * @return void
     */
    private function _load_env(): void
    {
        Dotenv\Dotenv::createImmutable(ENV_PATH)->load();
    }
    
    /**
    * Read files and folders in the system folder
     *
    * @return void
    */
    private function _load_system(): void
    {
        _load_system_files(SYSTEM_LOAD_PATH);
    }

    /**
     * Error handling read
     *
     * @return void
     */
    private function _load_error(): void
    {
        ini_set(SET_LOG_ERRORS, IS_ON);

        ini_set(SET_ERROR_LOG, ERROR_LOG_PATH);
        
        error_reporting(E_ALL);
    
        ini_set(SET_DISPLAY_ERRORS, IS_OFF);
    
        $_error_class_name = ERROR_CLASS_NAME;
    
        $_error_obj = new $_error_class_name;
    
        set_error_handler([$_error_obj, ERROR_HANDLER_METHOD]);
        register_shutdown_function([$_error_obj, ERROR_SHUTDOWN_HANDLER_METHOD]);
    }

    /**
     * Read route related files in the app folder 
     *
     * @return void
     */
    private function _load_app_route(): void
    {
        _load_app_files(ROUTES_PATH);
    }

    /**
     * Show 404 if url doesn't match route
     *
     * @return void
     */
    private function _load_not_route_display(): void
    {
        _Error::_response_error_http_status_code(HTTP_STATUS_CODE_404);
    }
}
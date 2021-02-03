<?php


/*
|--------------------------------------------------------------------------
| Loader class
|--------------------------------------------------------------------------
*/

class _Loader {

    public function __construct()
    {   
        $this->_load_system();

        $this->_load_error();
        
        $this->_load_app_route();
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
        _load_set_error();
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
}
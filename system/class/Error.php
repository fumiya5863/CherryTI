<?php

/*
|--------------------------------------------------------------------------
| Error class
|--------------------------------------------------------------------------
*/

class _Error {

    /**
     * error
     *
     * @var array
     */
    private $_error;
    
    /**
     * Error handling
     *
     * @param int $_level
     * @param string $_message
     * @param string $_file
     * @param int $_line
     * @return void
     */
    public function _error_handler(int $_level, string $_message, string $_file, int $_line): void
    {
        $this->_error = get_defined_vars();
           
        if ($_ENV["APP_ERROR_LOG"] === "On") {
            $this->_error_log();
        }
        
        $this->_error_run();
    }

    /**
     * Receive error handling that the set_error_handler function cannot handle
     *
     * @return void
     */
    public function _error_shutdown_handler(): void
    {
        if (!($_tmp_error = error_get_last())) {
            return;
        }
        $this->_error = array_combine([LEVEL, MESSAGE, FILE, LINE], $_tmp_error);

        $_is_error = $this->_is_error_type();
        
        if ($_is_error){
            $this->_error_run();
        }
   }

   /**
    * Error HTTP status code returned
    *
    * @param int $_http_status_code
    * @return void
    */
   public static function _response_error_http_status_code(int $_http_status_code): void
   {
        http_response_code($_http_status_code);
        require_once(TEMPLATE_PATH . "error_status_code.php");
        exit;
   } 

   /**
    * Whether it matches the type of error
    *
    * @return boolean
    */
   private function _is_error_type(): bool
   {
       return array_key_exists($this->_error[LEVEL], ERROR_LEVELS);
   }

   /**
    * A series of error control
    *
    * @return void
    */
   private function _error_run(): void
   {
        if ($_ENV["APP_DEBUG"] === "On") {
            $this->_error_display();
        } else {
            $this->_response_error_http_status_code(HTTP_STATUS_CODE_500);
        }
        exit;
   } 

   /**
    * Write error log
    *
    * @return void
    */
    private function _error_log(): void
    {
        error_log("PHP " . ERROR_LEVELS[$this->_error[LEVEL]] . " " . $this->_error[MESSAGE] . " " . $this->_error[FILE] . " " . $this->_error[LINE]);
    }

    /**
     * Error_display
     *
     * @return void
     */
    private function _error_display(): void
    {
        extract($this->_error);
        require_once(ERROR_TEMPLATE_FILE);
    }
}
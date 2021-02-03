<?php

/*
|--------------------------------------------------------------------------
| Error class
|--------------------------------------------------------------------------
*/

class _Error {

    private $_error_set;
    
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
        $this->_error_value_set($_level, $_message, $_file, $_line);
        
        if (_load_env("APP_ERROR_LOG") === 'true') {
            $this->_error_log();
        }
        
        $this->_error_run();
    }

    /**
     * Receive error handling that the set_error_handler function cannot handle
     *
     * @return void
     */
    public function _error_shutdown_handler()
    {
        if (!($_error = error_get_last())) {
            return;
        }

        $_is_error = $this->_is_error_type($_error);
        
        if ($_is_error){
            $this->_error_value_set($_error["type"], $_error["message"], $_error["file"], $_error["line"]);
            $this->_error_run();
        }
   }

   /**
    * Undocumented function
    *
    * @param int $_level
    * @param string $_message
    * @param string $_file
    * @param int $_line
    * @return void
    */
   private function _error_value_set(int $_level, string $_message, string $_file, int $_line): void
   {
       $this->_error_set = [
           "_level" => $_level,
           "_message" => $_message,
           "_file" => $_file,
           "_line" => $_line,
       ];
   }

   /**
    * Whether it matches the type of error
    *
    * @param array $_error
    * @return boolean
    */
   private function _is_error_type(array $_error): bool
   {
       $_is_error = false;
        switch($_error["type"]){
            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_CORE_WARNING:
            case E_COMPILE_ERROR:
            case E_COMPILE_WARNING:
                $_is_error = true;
                break;
        }
        return $_is_error;
   }

   /**
    * A series of error control
    *
    * @return void
    */
   private function _error_run(): void
   {
        if (_load_env("APP_DEBUG") === 'true') {
            $this->_error_display();
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
        error_log("PHP " . ERROR_NAMES[$this->_error_set["_level"]] . " " . $this->_error_set['_message'] . " " . $this->_error_set['_file'] . " " . $this->_error_set['_line']);
    }

    /**
     * Error_display
     *
     * @return void
     */
    private function _error_display(): void
    {    
        extract($this->_error_set);
        require_once(ERROR_TEMPLATE_FILE);
    }
}
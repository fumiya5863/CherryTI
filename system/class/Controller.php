<?php

/*
|--------------------------------------------------------------------------
| Parent controller
|--------------------------------------------------------------------------
*/

class _Controller {

    private $_exclusion_load_class = [
        "Controller",
        "Router",
        "Loader",
        "Error"
    ];

    public function __construct()
    {
        $this->_load_expansion_class();
    }
    
    /**
     * Read files in view folder
     *
     * @param string $_view_path
     * @param mixed $_items
     * @return void
     */
    protected function _load_view(string $_view_path, $_items = ''): void
    {
        !is_array($_items) && $_items = [$_items];
        foreach($_items as $_key => $_item) {
            ${$_key} = $_item;
        }
        
        require_once(VIEWS_PATH . $_view_path . EXTENSION_PHP);
    }

    /**
     * load model
     *
     * @param string $_model_name
     * @return void
     */
    protected function _load_model(string $_model_name): void
    {
        // Supports variable length arguments
        $args = func_get_args();
        $delete_key = array_flip($args)[$_model_name];
        unset($delete_key);
        
        require_once(MODEL_PATH . $_model_name . EXTENSION_PHP);
        $this->$_model_name = new $_model_name(...$args);
    }

    /**
     * Load the class to extend
     *
     * @return void
     */
    protected function _load_expansion_class(): void
    {
        foreach(_get_file_names(SYSTEM_LOAD_PATH[CLASS_PATH]) as $_class_name) {
            if (!in_array($_class_name, $this->_exclusion_load_class)) {
                $_load_class_name = SEPARATORS['underbar'] . $_class_name;
                $this->$_class_name = new $_load_class_name();
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param string $_file_name
     * @return void
     */
    protected function _load_library($_library_name): void
    {
        $this->$_library_name = new $_library_name();
    }
}
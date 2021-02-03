<?php

/*
|--------------------------------------------------------------------------
| Parent controller
|--------------------------------------------------------------------------
*/

class _Controller {

    private $_not_load_class = [
        "Controller",
        "Router",
        "Loader",
        "Error"
    ];
    
    /**
     * Read files in view folder
     *
     * @param string $_view_path
     * @param mixed $_items
     * @return void
     */
    protected function _load_view(string $_view_path, $_items = ''): void
    {
        foreach(is_array($_items) ? $_items : [$_items] as $_key => $_item) {
            $$_key = $_item;
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
        require_once(MODEL_PATH . $_model_name . EXTENSION_PHP);
        $this->$_model_name = new $_model_name();
    }

    /**
     * Load the class to extend
     *
     * @return void
     */
    protected function _load_expansion_class(): void
    {
        foreach(_is_loaded_class() as $_class_name) {
            if (!in_array($_class_name, $this->_not_load_class)) {
                $_load_class_name = SEPARATORS['underbar'] . $_class_name;
                $this->$_class_name = new $_load_class_name();
            }
        }
    }
}
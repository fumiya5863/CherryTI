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
        // 短絡評価（ショートサーキット）
        !is_array($_items) && $_items = [$_items];

        foreach(is_array($_items) ? $_items : [$_items] as $_key => $_item) {
            // 目が疲れていなくても可変変数だと明示的に分かりやすく優しい？
            // ${$_key} = $_item;
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

    // 子クラスのコンストラクタに引数（可変長）を入れたい場合があるかも？
    protected function __load_model(string $_model_name): void
    {
        $args = func_get_args();
        // 可変長引数対応
        $delete_key = array_flip(
            $args
        )[$_model_name];
        unset($delete_key);

        require_once(MODEL_PATH . $_model_name . EXTENSION_PHP);

        // classのインスタント生成時（コンストラクタ）に可変長引数を渡せる
        $this->$_model_name = new $_model_name(...$args);
    }

    /**
     * Load the class to extend
     *
     * @return void
     */
    protected function _load_expansion_class(): void
    {
        // _get_file_namesが良いかも？
        // こういうのもある => get_declared_classes()
        foreach(_is_loaded_class() as $_class_name) {
            // _not_load_classは"除外"、"禁止"、"ブラックリスト"を連想できるクラスプロパティだと良い？
            if (!in_array($_class_name, $this->_not_load_class)) {
                // appのクラスインスタンスを生成するならFW制約（prefixが"_"）設けないほうが良い？
                // ユーザ入力値（引数？子クラスのプロパティ？configファイル？）から上手く立ち回る
                $_load_class_name = SEPARATORS['underbar'] . $_class_name;
                $this->$_class_name = new $_load_class_name();
            }
        }
    }
}
<?php

/*
|--------------------------------------------------------------------------
| Set common functions in system
|--------------------------------------------------------------------------
*/

/**
 * Read files and folders in the system folder
 *
 * @param array $_system_paths
 * @return void
 */
function _load_system_files(array $_system_paths): void
{
    foreach($_system_paths as $_path => $_files) {
        foreach($_files as $_file) {
            
            if ($_path === CLASS_PATH) {
                // 返却値あるなら使う（実装揺れ
                _is_loaded_class($_file);
            }
            
            require_once($_path . $_file);
        }
    }
}

/**
 * Stores the name of the loaded class
 *
 * @param string $_file
 * @return array
 */
// "is_*"はbool値返却するときに使う
// get_class_names？
function _is_loaded_class(string $_file = ""): array
{
    static $_class_names = [];

    if (!empty($_file)) {
        // basename
        $_class_names[] =  str_replace(EXTENSION_PHP, "", $_file);
    }
    
    return $_class_names;
}


// 配列に格納されている（パス付きの）ファイル一覧から拡張子を除去したファイル名一覧を返却する
function _get_file_names(array $_files): array
{
    return array_map(
        "_get_file_name",
        $_files
    );
}

// （パス付きの）のファイルから拡張子を除去したファイル名一覧を返却する
function _get_file_name(string $_file = ""): string
{
    $_extension = pathinfo($_file, PATHINFO_EXTENSION);
    return basename($_file, "." . $_extension);
}

/**
 * Error handling settings
 *
 * @return void
 */
// 一回しか呼び出すことは無い
// Loaderの中にprivateで閉じ込めたほうが責務として保たれる？
function _load_set_error(): void
{
    ini_set(SET_LOG_ERRORS, IS_ON);

    ini_set(SET_ERROR_LOG, ERROR_LOG_PATH);
    
    error_reporting(E_ALL);

    ini_set(SET_DISPLAY_ERRORS, IS_OFF);

    $_error_class_name = ERROR_CLASS_NAME;

    $_error_obj = new $_error_class_name;

    // arrayと[]で揺れているから統一したほうが良い？
    set_error_handler(array($_error_obj, ERROR_HANDLER_METHOD));
    register_shutdown_function(array($_error_obj, ERROR_SHUTDOWN_HANDLER_METHOD));
}

/**
 * Read a file from a folder inside the app folder
 *
 * @param string $_load_app_folder
 * @param string $_load_app_file
 * @return void
 */
function _load_app_files(string $_load_app_folder, string $_load_app_file = ""): void
{

    // ユーザが責務毎にroute設定を書けるメリットがある
    // 特段意図が無ければFW側で縛るか、appにconfig用意する
    $_file_paths = _get_all_files($_load_app_folder);
    // strlenでbyte数を使って判定したほうが読む側に優しい？
    if (!empty($_load_app_file)) {
        $_file_paths = [
            $_load_app_folder . $_load_app_file . EXTENSION_PHP
        ];
    }
    
    foreach($_file_paths as $_file_path) {
        require_once($_file_path);
    }
}

/**
 * Get all files in the specified folder
 *
 * @param string $_folder
 * @return array
 */
function _get_all_files(string $_folder): array
{    
    return glob($_folder . "*" . EXTENSION_PHP);
}

/**
 * Call the value of env
 *
 * @param string $_key
 * @return string
 */
function _load_env(string $_key): string
{
    // スーパーグローバル変数の$_ENVに入るから返却不要
    // Dotenv\Dotenv::createImmutable(ENV_PATH)->load();
    $dotenv = Dotenv\Dotenv::createImmutable(ENV_PATH);
    $dotenv->load();
    return array_key_exists($_key, $_ENV) ? $_ENV[$_key] : '';
}
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
            require_once($_path . $_file);
        }
    }
}

/**
 * Returns an array of names with the file extension removed
 *
 * @param array $_files
 * @return array
 */
function _get_file_names(array $_files): array
{
    return array_map("_get_file_name", $_files);
}

/**
 * Get the part of the name with the extension of the file
 *
 * @param string $_file
 * @return string
 */
function _get_file_name(string $_file): string
{
    return pathinfo($_file, PATHINFO_FILENAME);
}

/**
 * Read a file from a folder inside the app folder
 *
 * @param string $_load_app_folder
 * @return void
 */
function _load_app_files(string $_load_app_folder): void
{

    $_file_paths = _get_all_files($_load_app_folder);
    
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

<?php

/*
|--------------------------------------------------------------------------
| Parent model setting
|--------------------------------------------------------------------------
*/

use Illuminate\Database\Capsule\Manager as DB;

class _Model {

    protected $db;
    
    public function __construct()
    {
        $this->db = $this->_connect();
    }

    /**
     * Initialize DB connection
     *
     * @return object
     */
    private function _connect(): object
    {
        $database = new DB();

        $database->addConnection(DB_CONFIG);

        $database->setAsGlobal();

        $database->bootEloquent();

        return $database->connection();
    }

    /**
     * Convert object to a two-dimensional array
     *
     * @param object $_array
     * @return array
     */
    protected function _result_array(object $_array): array
    {
        $_confirm_arrays = [];
        foreach($_array as $_keys => $_object) {
            $_confirm_arrays[] = (array)$_object;
        }
        return $_confirm_arrays;
    }
}
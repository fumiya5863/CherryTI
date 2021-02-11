<?php

/*
|--------------------------------------------------------------------------
| Parent model setting
|--------------------------------------------------------------------------
*/

use Illuminate\Database\Capsule\Manager as DB;

class _Model {

    protected $_db;
    
    public function __construct()
    {
        $this->_db = $this->_connect();
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
}
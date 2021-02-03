<?php

class Hello extends _Controller {

    public function __construct()
    {
        $this->_load_expansion_class();
    }

    public function index()
    {
        $this->_load_view('hello_world');
    }
}
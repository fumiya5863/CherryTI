<?php

class Hello extends _Controller {
    
    public function __construct()
    {
        $this->_load_helper('Session');
    }
    
    public function index()
    {
        $this->_load_view('hello_world');
    }
}
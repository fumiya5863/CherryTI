<?php

class Hello extends _Controller {
    
    public function index()
    {
        $this->_load_library('Session');
        $this->_load_view('hello_world');
    }
}
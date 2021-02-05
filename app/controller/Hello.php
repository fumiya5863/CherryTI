<?php

class Hello extends _Controller {

    public function index()
    {
        $this->load_view('hello_world');
    }
}
<?php
namespace App\Http\Services;

Class PagSeguro implements Service {

    public function __construct() {
        try {
            \PagSeguro\Library::initialize();
        } catch (\Exception $e) {
            die($e);
        }
    }
    
}
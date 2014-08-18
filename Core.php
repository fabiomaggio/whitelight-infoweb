<?php
namespace Infoweb;

class Core {
    
    // Class constants
    const VERSION = '0.0.1';
    
    /**
     * Returns the version number
     * 
     * @return  string      The version number
     */
    public static function version() {
        return self::VERSION;
    }    
}
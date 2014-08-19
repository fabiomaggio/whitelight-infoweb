<?php
namespace Infoweb;

class App
{    
    // Class constants
    const VERSION = '0.0.1';
    
    public static $data = null;
    
    /**
     * Returns the version number
     * 
     * @return  string      The version number
     */
    public static function version()
    {
        return self::VERSION;
    }
    
    /**
     * Gets or sets the application data
     * 
     */
    public static function data($data = null)
    {
        if ($data !== null)
            self::$data = $data;
        
        return self::$data;
    }    
}
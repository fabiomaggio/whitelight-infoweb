<?php
namespace Infoweb;

class App
{    
    // Class constants
    const VERSION = '0.0.1';
    
    /**
     * @var array   The application data
     */
    public static $data = null;
    
    /**
     * @var string  The application language
     */
    public static $language = 'nl';
    
    /**
     * @var int     The active menu item
     */
    public static $menuItem = 0;
    
    /**
     * @var int     The active page
     */
    public static $page = 0;
    
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
     * Returns the url of the previous page in the navigation
     * 
     * @return  string      The url of the previous page
     */
    public static function urlPreviousPage()
    {
        // A previous page within the current menu-item exists, return to it
        if (isset(self::$data->menuItems[self::$menuItem]->pages[self::$page - 1])) {
            $previousPage = 'page.php?m=' . self::$menuItem . '&p=' . (self::$page - 1);
            
        // No previous page is set but a previous menu-item exists so return to its last page
        } elseif (isset(self::$data->menuItems[self::$menuItem - 1])) {
            // Get the index of the last page
            $amountOfPages = count(self::$data->menuItems[self::$menuItem - 1]);
            $previousPage = 'page.php?m=' . (self::$menuItem - 1) . '&p=' . ($amountOfPages - 1);
                
        // No previous menu-item exists, return to the selection
        } else {
            $previousPage = 'selection.php';
        }
        
        return $previousPage;    
    }
    
    /**
     * Returns the url of the next page in the navigation
     * 
     * @return  string      The url of the next page
     */
    public static function urlNextPage()
    {
        // A next page within the current menu-item exists, forward to it
        if (isset(self::$data->menuItems[self::$menuItem]->pages[self::$page + 1])) {
            $nextPage = 'page.php?m=' . self::$menuItem . '&p=' . (self::$page + 1);
            
        // No next page is set but a next menu-item exists so forward to its first page
        } elseif (isset(self::$data->menuItems[self::$menuItem + 1])) {
            $nextPage = 'page.php?m=' . (self::$menuItem + 1) . '&p=0';
                
        // No next menu-item exists
        } else {
            $nextPage = '';
        }
        
        return $nextPage;     
    }   
}
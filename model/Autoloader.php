<?php
/****************************************MODEL/AUTOLOADER.PHP****************************************/

namespace Youngbokz\Blog_Forteroche\Model;

/**
 * class Autoloader
 * Generate an autoloader to call different class 
 */
class Autoloader
{
    /**
     * register
     *
     * register function call spl function which have @param __CLASS__(class Autoloader), and the function autoload
     * 
     * @return void
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    
    /**
     * autoload
     *
     * @param  string $className Allows to call any class, so no need to require each class every time needed
     *
     * @return void
     */
    static function autoload($className)
    {
        require 'class/' . $className . '.php'; 
    }
}
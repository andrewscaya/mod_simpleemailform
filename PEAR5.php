<?php
/**
 * This is only meant for PHP 5 to get rid of certain strict warning
 * that doesn't get hidden since it's in the shutdown function
 */
class PEAR5
{
    /**
    * If you have a class that's mostly/entirely static, and you need static
    * properties, you can use this method to simulate them. Eg. in your method(s)
    * do this: $myVar = &PEAR5::getStaticProperty('myclass', 'myVar');
    * You MUST use a reference, or they will not persist!
    * 
    * 2011-07-23 DB: rewrote to make $properties a a separate public entity
    *
    * @access public
    * @param  string $class  The calling classname, to prevent clashes
    * @param  string $var    The variable to retrieve.
    * @return mixed   A reference to the variable. If not set it will be
    *                 auto initialised to NULL.
    */
    
    public static $properties;
    
    static function getStaticProperty($class, $var)
    {
        if (!isset(self::$properties[$class])) {
            self::$properties[$class] = array();
        }

        if (!array_key_exists($var, self::$properties[$class])) {
            self::$properties[$class][$var] = null;
        }

        return self::$properties[$class][$var];
    }
}

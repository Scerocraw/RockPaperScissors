<?php

/**
 * 
 */
class Micro_Session {

    private static $_sessionInstance;

    /**
     * Instance the session
     * @return Session
     */
    public static function instance() {
        self::$_sessionInstance = Session::instance();
        
        return self::$_sessionInstance;
    }

    /**
     * Setter for the session
     * @param $key
     * @param $value
     */
    public static function set($key, $value) {
        self::$_sessionInstance->set($key, $value);
    }

    /**
     * Getter for the session
     * @param $key
     * @return mixed
     */
    public static function get($key) {
        return self::$_sessionInstance->get($key);
    }
    
    /**
     * Destroy the session
     * @return type
     */
    public static function destroy() {        
        return self::$_sessionInstance->destroy();
    }
}

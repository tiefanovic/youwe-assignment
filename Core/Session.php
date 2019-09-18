<?php
/**
 * Session
 *
 * @copyright Copyright © 2019 AWstreams. All rights reserved.
 * @author    ahmed.atef@awstreams.com
 */

namespace Core;



class Session
{
    /**
     * Session Age.
     *
     * The number of seconds of inactivity before a session expires.
     *
     * @var integer
     */
    protected static $SESSION_AGE = 3600*24;

    public static function write($key, $value)
    {
        if ( !is_string($key) )
            throw new \Exception('Session key must be string value');
        self::_init();
        $_SESSION[$key] = $value;
        self::_age();
        return $value;
    }

    public static function read($key, $child = false)
    {
        if ( !is_string($key) )
            throw new \Exception('Session key must be string value');
        self::_init();
        if (isset($_SESSION[$key]))
        {
            self::_age();

            if (false == $child)
            {
                return $_SESSION[$key];
            }
            else
            {
                if (isset($_SESSION[$key][$child]))
                {
                    return $_SESSION[$key][$child];
                }
            }
        }
        return false;
    }

    public static function delete($key)
    {
        if ( !is_string($key) )
            throw new \Exception('Session key must be string value');
        self::_init();
        unset($_SESSION[$key]);
        self::_age();
    }

    /**
     * Echos current session data.
     *
     * @return void
     */
    public static function dump()
    {
        self::_init();
        echo nl2br(print_r($_SESSION));
    }

    public static function start()
    {
        return self::_init();
    }


    private static function _age()
    {
        $last = isset($_SESSION['LAST_ACTIVE']) ? $_SESSION['LAST_ACTIVE'] : false ;

        if (false !== $last && (time() - $last > self::$SESSION_AGE))
        {
            self::destroy();
            throw new \Exception();
        }
        $_SESSION['LAST_ACTIVE'] = time();
    }

    /**
     * Returns current session cookie parameters or an empty array.
     *
     * @return array Associative array of session cookie parameters.
     */
    public static function params()
    {
        $r = array();
        if ( '' !== session_id() )
        {
            $r = session_get_cookie_params();
        }
        return $r;
    }

    public static function close()
    {
        if ( '' !== session_id() )
        {
            session_write_close();
            return true;
        }
        return true;
    }


    public static function commit()
    {
        return self::close();
    }

    /**
     * Removes session data and destroys the current session.
     *
     * @return void
     */
    public static function destroy()
    {
        if ( '' !== session_id() )
        {
            $_SESSION = array();

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();
        }
    }

    private static function _init()
    {
        if (function_exists('session_status'))
        {
            // PHP 5.4.0+
            if (session_status() == PHP_SESSION_DISABLED)
                throw new \Exception();
        }

        if ( '' === session_id() )
        {
            $secure = true;
            $httponly = true;

            // Disallow session passing as a GET parameter.
            // Requires PHP 4.3.0
            if (ini_set('session.use_only_cookies', 1) === false) {
                throw new \Exception();
            }

            // Mark the cookie as accessible only through the HTTP protocol.
            // Requires PHP 5.2.0
            if (ini_set('session.cookie_httponly', 1) === false) {
                throw new \Exception();
            }

            $params = session_get_cookie_params();
            session_set_cookie_params($params['lifetime'],
                $params['path'], $params['domain'],
                $secure, $httponly
            );

            return session_start();
        }
        return session_regenerate_id(true);
    }

}
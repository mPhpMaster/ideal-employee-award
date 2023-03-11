<?php

defined('STATUS_INACTIVE') || define('STATUS_INACTIVE', 0);
defined('STATUS_ACTIVE') || define('STATUS_ACTIVE', 1);

if( !function_exists('hasConst') ) {
    /**
     * Check if given class has the given const.
     *
     * @param mixed  $class     <p>
     *                          Either a string containing the name of the class to
     *                          check, or an object.
     *                          </p>
     * @param string $const     <p>
     *                          Const name to check
     *                          </p>
     *
     * @return bool
     */
    function hasConst($class, $const): bool
    {
        $hasConst = false;
        try {
            if( is_object($class) || is_string($class) ) {
                $reflect = new ReflectionClass($class);
                $hasConst = array_key_exists($const, $reflect->getConstants());
            }
        } catch(ReflectionException $exception) {
            $hasConst = false;
        } catch(Exception $exception) {
            $hasConst = false;
        }

        return (bool) $hasConst;
    }
}

if( !function_exists('getConst') ) {
    /**
     * Returns const value if exists, otherwise returns $default.
     *
     * @param string|array $const   <p>
     *                              Const name to check
     *                              </p>
     * @param mixed|null   $default <p>
     *                              Value to return when const not found
     *                              </p>
     *
     * @return mixed
     */
    function getConst($const, $default = null)
    {
        return defined($const = is_array($const) ? implode("::", $const) : $const) ? constant($const) : $default;
    }
}

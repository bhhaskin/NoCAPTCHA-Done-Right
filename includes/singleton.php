<?php
/**
 * @package   Nocaptcha_Done_Right
 * @author    Bryan Haskin <bhhaskin@gmail.com>
 * @license   MIT
 * @link      https://bryans.website
 * @copyright 2015 Bryan Haskin
 * @since 0.1
 **/

namespace ndr;

/**
 * Singleton class
 */
class Singleton
{
    public static function get_instance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    protected function __construct() {}
    private function __clone()       {}
    private function __wakeup()      {}
}

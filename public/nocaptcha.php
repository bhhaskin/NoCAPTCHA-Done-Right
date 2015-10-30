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
 * Main class for plugin
 */
class Nocaptcha extends Singleton
{
    //used for cache-busting of enqueue
    const VERSION = '0.1';
    protected $plugin_slug = 'nocaptcha-done-right';

    protected function __construct ()
    {
        add_action('init', array($this, 'load_plugin_textdomain'));
    }

    public function get_plugin_slug()
    {
        return $this->plugin_slug;
    }

    public function load_plugin_textdomain()
    {
        $domain	 = $this->plugin_slug;
        $locale	 = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
    }

}

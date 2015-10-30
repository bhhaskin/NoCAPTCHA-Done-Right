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
 * Retrieve Options From Wordpress
 */
class Retrieve_Options extends Singleton
{
    public $options = null;

    public function __construct()
    {
        $this->options = maybe_unserialize( get_option( NDR_OPTION_NAME ) );
    }

    public function get_option( $setting_name )
    {
        if ( $this->options == NULL ) {
			$this->options = maybe_unserialize( get_option( NDR_OPTION_NAME ) );
		}
        if ( is_array($this->options) && !empty($this->options) && array_key_exists( $setting_name, $this->options ) ) {
			return $this->options [ $setting_name ];
		} else {
			return false;
		}
    }

}

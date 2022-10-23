<?php
/**
 * Bootstraps the Theme.
 * C:\xampp\htdocs\futurewordpress.com\wp-content\themes\aquila
 *
 * @package Future Wordpress Project.
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class FUTUREWORDPRESS_PROJECT {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
    // Load class.
		Assets::get_instance();
		Menus::get_instance();
		Meta_Boxes::get_instance();
		Option::get_instance();
		// Sidebars::get_instance();
		Blocks::get_instance();
		Block_Patterns::get_instance();
		Loadmore_Single::get_instance();
		// Loadmore_Posts::get_instance();
		Clock_Widget::get_instance();
		Futurewordpress_Database::get_instance();
		Register_Post_Types::get_instance();
		Register_Taxonomies::get_instance();
		// Archive_Settings::get_instance();
    Update::get_instance();
	}
	protected function setup_hooks() {
		add_filter( 'futurewordpress/project/job/currencies', [ $this, 'jobCurrencies' ], 10, 1 );
		add_action( 'plugins_loaded', [ $this, 'installHook' ], 10, 0 );
		add_action( 'init', [ $this, 'loadTextdomain' ], 1, 0 ); // plugins_loaded
		add_action( 'body_class', [ $this, 'body_class' ], 1, 1 ); // plugins_loaded
  }
	public function installHook() {
		register_activation_hook( __FILE__, [ $this, 'onInstall' ] );
		register_deactivation_hook( __FILE__, [ $this, 'unInstall' ] );
	}
	public function onInstall() {
    global $wpdb;
		$sql = [
      'favourite'   => "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}fwp_job_favourite (ID SERIAL NOT NULL , post_id INT NOT NULL , user_id INT NOT NULL , created_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB COMMENT = 'This table created by Advanced-job-opening plugin';",
      'cv'          => "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}fwp_job_cv (ID SERIAL NOT NULL , user_id INT NOT NULL , cv_name TEXT NOT NULL , cv_path TEXT NOT NULL , last_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB COMMENT = 'This table created by Advanced Job Opening';",
      'cv'          => "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}fwp_job_application (ID SERIAL NOT NULL , user_id INT NOT NULL , job_id INT NOT NULL , cv_id INT NOT NULL , coverletter MEDIUMTEXT NOT NULL , created_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB COMMENT = 'This table created by Advanced Job Opening Plugin';",
		];
    // $sql[ 'favourite' ]
    // $wpdb->prefix . 'fwp_job_favourite'
	}
	public function unInstall() {}
	public function loadTextdomain() {
		load_plugin_textdomain( FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	public function jobCurrencies( $args ) {
		$arr = [
			'AED' => '&#1583;.&#1573;',
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'AMD' => '',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;',
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;',
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;',
			'BIF' => '&#70;&#66;&#117;',
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;',
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLF' => '',
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;',
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;',
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;',
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;',
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;',
			'GNF' => '&#70;&#71;',
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;',
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => '&#1593;.&#1583;',
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;',
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;',
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;',
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;',
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;',
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;',
			'MAD' => '&#1583;.&#1605;.', //?
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;',
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;',
			'MRO' => '&#85;&#77;',
			'MUR' => '&#8360;',
			'MVR' => '.&#1923;',
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;',
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;',
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;',
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;',
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;',
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;',
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => '',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XDR' => '',
			'XOF' => '',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;',
			'ZWL' => '&#90;&#36;',
		];
		$row = [];
		foreach( $arr as $a => $av ) {
			if( ! empty( $av ) ) {
				$row[ $a ] = $a;
			}
		}
		return $row;
	}
  public function body_class( $classes ) {
    if( is_array( $classes ) ) {$classes = (array) $classes;}
    $classes[] = 'fwp-ajo';
    return $classes;
  }

}

<?php
/**
 *  Plugin Name: WP Engine Browser Metrics
 *  Author URI: https://wpengine.com/
 *  Description: Enables users to collect performance information from a sample of page views, and shares collected data with WP Engine for processing. Collection is specifically enabled for: Time to First Byte, Largest Contentful Paint, First Input Delay, and Cumulative Layout Shift. The analysis provided by WP Engine will allow users to understand the real-world user experience on their sites, defined in terms of Core Web Vitals metrics, and make decisions for focused site performance optimization.
 *  Author: WP Engine
 *  License: GPL v2 or later
 *  License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *  Text Domain: wp-engine-browser-metrics
 *  Domain Path: /languages
 *  Version:     1.0.2
 */

class WPWebVitalsTracking {


    public function __construct() {
        add_action('wp_enqueue_scripts', array( $this, 'add_webvitalsscript' ));

    }//end __construct()


    public function add_webvitalsscript() {
        $plugin_version = '1.0.2';

        wp_enqueue_script('webvitals-tracking', plugin_dir_url(__FILE__) . 'webvitals-0.2.2.js', array(), $plugin_version, true);
        wp_localize_script(
            'webvitals-tracking',
            'web_vitals_config',
            array(
                'metrics_receiver_url'     => 'https://web-vitals-receiver-dzto3zxp3a-ue.a.run.app/v2/metrics',
                'metrics_receiver_url_dev' => 'https://web-vitals-receiver-foz5bdl5ia-ue.a.run.app/v2/metrics',
                'hosting_id'               => PWP_NAME,
                'plugin_ver'               => $plugin_version,
                'served_by'                => gethostname(),
            )
        );

    }//end add_webvitalsscript()


    // end class
}//end class



if ( true === defined('PWP_NAME') ) {
    new WPWebVitalsTracking();
};

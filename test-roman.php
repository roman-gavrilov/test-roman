<?php
/**
 * This is the main php file of the Test Plugin.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Roman_Test_Plugin
 * @author   Roman Gavrilov <uername@example.com>
 * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU GPLv2
 * @version  GIT: <git_id>
 * @link     TBD
 */


/*
   Plugin Name: Roman - Test Plugin
   description: Outputs "hello world" in the newest post via browser console.
   Version: 1.0
   Author: Roman Gavrilov
   Author URI: https://www.upwork.com/freelancers/~016f60f8c2665a63b1
*/

if (! class_exists('RomanTestPlugin')) {

    /**
     * Main class of the test plugin
     *
     * @category PHP
     * @package  Roman_Test_Plugin
     * @author   Roman Gavrilov <uername@example.com>
     * @license  https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU GPLv2
     * @link     TBD
     */
    class RomanTestPlugin
    {

        /**
         * Constructor of the plugin class
         *
         * @return void
         */
        function __construct()
        {
            add_action('wp_footer', array($this, 'mainFunction'));
        }

        /**
         * An action hook to the "wp_footer"
         *
         * @return void
         */
        function mainFunction()
        {
            global $post;
            if (!is_singular('post')) {
                return;
            }

            $recent_posts = wp_get_recent_posts(
                array(
                    'numberposts' => 1,
                    'post_status' => 'publish'
                ),
                OBJECT
            );
            if (!$recent_posts) {
                return;
            }

            if ($post->ID == $recent_posts[0]->ID) {
                printf('<script>console.log("Hello World!"); </script>');
            }
        }
    }

    $roman_test = new RomanTestPlugin();
}
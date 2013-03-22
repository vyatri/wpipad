<?php
    /*
    Plugin Name: WP-iPad
    Plugin URI: http://www.dhezign.com
    Description: Plugin for calling specific theme when displaying wordpress on iPad. Has the ability to switch to full-site theme and vice versa.
    Author: Juanita Vyatri
    Version: 1.0
    Author URI: http://www.dhezign.com
    */

    /*  Copyright 2011  Juanita Vyatri  (email : jbuzz547@ymail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */
    
    session_start();
    //define("WPIPAD_THEME","sepia");
    define("WPIPAD_THEME","slablet");
	define("tesgit","iya");

    function wpipad_template($theme) {
        if (wpipad_installed()) {
            return apply_filters('wpipad_template', WPIPAD_THEME);
        } else {
            return $theme;
        }
    }

    function wpipad_installed() {
        return is_dir(ABSPATH.'/wp-content/themes/'.WPIPAD_THEME);
    }

        if (is_admin() != TRUE) {
            $url = parse_url(get_bloginfo('url'));
            if (!empty($url['path'])) {
                $path = str_replace("/","",$url['path']);
            }
            else {
                $path = '';
            }
            $pathLength = strlen($path);
            // if wpipadoff - destroy session - redirect to full site
            if (substr($_SERVER['REQUEST_URI'],0,(10+$pathLength)) == $path.'/wpipadoff'){
                $_SESSION['wpipad'] = 'n';
                header("Location: ".get_bloginfo('home'));
                die;
            }
            // if wpipad - if belum ada, kasih session
            else if (substr($_SERVER['REQUEST_URI'],0,(9+$pathLength)) == $path.'/wpipadon'){
                $_SESSION['wpipad']='y';
                header("Location: ".get_bloginfo('home'));
                die;
            }
            
            if (!isset($_SESSION['wpipad'])) {
                // check jika dibuka di ipad
                $pos1 = strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
                $pos2 = strpos($_SERVER['HTTP_USER_AGENT'],'AppleWebKit');
                if ($pos1 !== false && $pos2 !== false){
                    $_SESSION['wpipad']='y';
                }
            }            
        }
    
    if ($_SESSION['wpipad'] == 'y') {
        add_filter('template', 'wpipad_template');
        add_filter('stylesheet', 'wpipad_template');
    }
?>
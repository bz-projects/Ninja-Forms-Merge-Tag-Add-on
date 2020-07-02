<?php
/*
Plugin Name: Ninja Forms Merge Tag Addon
Plugin URI:  https://wordpress.org/plugin/nf-merge-tag-addon/
Description: Add WordPress Tags to your Ninja Forms for the Admin Mail.
Version:     2.5
Text Domain: nfmta
Domain Path: /languages
Author:      Benjamin Zekavica
Author URI:  https://www.benjamin-zekavica.de
License:     GPL2

Ninja Forms Merge Tag Addon is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Ninja Forms Merge Tag Addon is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with Ninja Forms Merge Tag Addon. If not, see license.txt .

Copyright by:
(c) 2018 – 2020 by Benjamin Zekavica. All rights reserved.

Imprint:
Benjamin Zekavica
Oranienstraße 12
52066 Aachen

E-Mail: info@benjamin-zekavica.de
Web: www.benjamin-zekavica.de

I don't give support by Mail. Please write in the
community forum for questions and problems.

--- Credits from Ninja Forms  ---
Ninja Forms Core: The WP Ninjas (wpninjasllc, Kevin Stover, James Laws,
Kyle B. Johnson, klhall1987, krmoorhouse, jmcelhaney and Zachary Skaggs)
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Ninja Forms checker 
require_once( plugin_dir_path( __FILE__ ). '/inc/plugin-check/plugin-install/nfmta-required.php' );

// Plugin Error messages
require_once( plugin_dir_path( __FILE__ ). '/inc/plugin-check/pluginchecker-messages.php' );
require_once( plugin_dir_path( __FILE__ ). '/inc/plugin-check/pluginchecker.php' );

// Merge Tags
require_once( plugin_dir_path( __FILE__ ). '/inc/merges/contents/merge-content-loader.php' );
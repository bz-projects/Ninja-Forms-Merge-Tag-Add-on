<?php
/*
Plugin Name: Ninja Forms Merge Tag Addon
Plugin URI:  https://wordpress.org/plugins/ninja-forms-merge-tags-addon
Version:     1.0
Author:      Benjamin Zekavica
Author URI:  http://www.benjamin-zekavica.de
Domain Path: /languages
License:     GPL2

Easy SVG is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
Easy SVG is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with Easy SVG. If not, see license.txt .


Copyright by: 
(c) 2017 - 2018 by Benjamin Zekavica. All rights reserved. 
Imprint: 
Benjamin Zekavica
Oranienstraße 12
52066 Aachen 

E-Mail: info@benjamin-zekavica.de
Web: www.benjamin-zekavica.de

I don't give support by Mail. Please write in the 
community forum for questions and problems.  

*/


add_action( 'ninja_forms_loaded', 'my_register_merge_tags' );

function my_register_merge_tags(){
  require_once 'class.mergetags.php';
  Ninja_Forms()->merge_tags[ 'my_merge_tags' ] = new My_MergeTags();
}

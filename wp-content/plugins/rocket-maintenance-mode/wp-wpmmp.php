<?php
/**
Plugin Name: Maintenance Mode
Plugin URI: http://web-settler.com/maintenance-mode/?ref=wpOrg
Description: Adds a responsive maintenance mode page to your site that lets visitors know your site is down.
Author: Muneeb
Author URI: http://web-settler.com/maintenance-mode/?ref=authoruri
Version: 3.7.3
Copyright: 2016 Muneeb ur Rehman http://muneeb.me/contact/
**/

require plugin_dir_path( __FILE__ ) . 'config.php';

require WPMMP_PLUGIN_INCLUDE_DIRECTORY . 'functions.php';

define( 'WPMMP_PRO_VERSION_ENABLED', true );

add_option( 'wpmmp_install_version', WPMMP_PLUGIN_VERSION );

load_wpmmp();


<?php 

$config['base_url'] = ''; // Base URL including trailing slash (e.g. http://localhost/)

$config['default_controller'] = 'main'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)

$config['db_host'] = ''; // Database host (e.g. localhost)
$config['db_name'] = ''; // Database name
$config['db_username'] = ''; // Database username
$config['db_password'] = ''; // Database password

/**
 * Map URI to class/method and ID and Page numbers
 * Must be an array
 */
$config['routes'] = array( 
    'about' => 'main',
    'blog/pages' => 'main/nope/2',
    'blog/post' => 'main/index',
    'blog/post/:num' => 'main/index/2',
    // 'blog/:any' => 'main/post/'
);
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$active_group = 'tecsur';
	$query_builder = TRUE;

	$db['tecsur'] = array(
		'dsn' => '',
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => '123456',
		'database' => 'tecsur',
		'dbdriver' => 'mysqli',
		'port' => '3307',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_spanish_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	);

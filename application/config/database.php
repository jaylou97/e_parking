<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'e_parking';
$query_builder = TRUE;

$db['e_parking'] = array(
	'dsn'	=> '',
	'hostname' => '172.16.43.109',
	'username' => 'root',
	'password' => 'thirteen',
	'database' => 'e_parking',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['pis'] = array(
	'dsn'	=> '',
	'hostname' => '172.16.161.34:3307',
	'username' => 'pis',
	'password' => 'itprog2013',
	'database' => 'pis',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

<?php

/**
 * DATABASE
 *
 * @descripcion En esta classe realizamos todas las transacciones a nivel de Base de Datos. 
 * @author VICTOR BACA
 * Fecha 5/8/2015
 */
 
 date_default_timezone_set('Europe/London');

class Database
{	
	
	protected $_server = 'localhost';
	protected $_database = 'cursos';
	protected $_user = 'root';
	protected $_password = '';
	
	protected $_connection;

}

<?php

/**
 * DATABASE
 *
 * @descripcion En esta classe realizamos todas las transacciones a nivel de Base de Datos. 
 * @author Antoni Arco Frias
 */
 
 date_default_timezone_set('Europe/London');

class Database
{
	/*protected $_server = 'localhost';
	protected $_database = 'db487206618';
	protected $_user = 'dbo487206618';
	protected $_password = 'Cofidis1';*/

	//protected $_server = '50.97.97.51';
	
	
	protected $_server = 'localhost';
	protected $_database = 'cursos';
	protected $_user = 'root';
	protected $_password = '';
	
	protected $_connection;

}


/*
 * EJEMPLOS
 // Create instance of Database to work with
 $database = new Database('localhost', 'mydatabase', 'root', '123456');


 // Get all users of table user
 $allUsers = $database->select('user');


 // Get all users beginning with the letter 'A'
 $usersBeginningWithLetterA = $database->select('users', '*', 'username LIKE \'A%\'');


 // Insert new user to table user and get ID of row inserted
 $userData = array(
 'username' => 'Max',
 'password' => 'as7d89',
 );


 $userId = $database->insert('user', $userData);
 echo $userId;


 // Update, e.g. to change users password
 $database->update('user', array('password' => 'as7d999'), 'username = \'Max\'');


 // Delete user again
 $database->delete('user', $userId);


 // Truncate table (delete all rows in table and set index back)
 $database->truncate('cache');
 */

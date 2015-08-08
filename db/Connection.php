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
	protected $_server = 'localhost';
	protected $_database = 'cursos';
	protected $_user = 'root';
	protected $_password = '';
	
	protected $_connection;

	/**
	 * Sends a query to database
	 *
	 * @param	string		Query
	 * @param	bool		get ID of the result
	 * @return	resource	Result
	 */
	protected function _sendQuery($query, $getId = false)
	{

		$this->_connection = mysql_connect($this->_server, $this->_user, $this->_password);
		
		
		
		if (!$this->_connection){ die('Could not connect: ' . mysql_error()); }

		mysql_select_db($this->_database, $this->_connection);
		
		mysql_query('SET CHARACTER SET utf8');
		
		mysql_query("SET NAMES utf8",$this->_connection);
		//print '</br> - CHIVATO: QUERY :'.$query;
		
		$result = mysql_query($query, $this->_connection);
		$tmpId  = mysql_insert_id($this->_connection);
		mysql_query("SET NAMES utf8",$this->_connection);
		
		mysql_close($this->_connection);

		if ($getId) {
			return $tmpId;
		}
		return $result;
	}
	
	
	protected function _sendQueryNoLog($query, $getId = false)
		{

		$this->_connection = mysql_connect($this->_server, $this->_user, $this->_password);

		if (!$this->_connection){ die('Could not connect: ' . mysql_error()); }

		mysql_select_db($this->_database, $this->_connection);
		
		mysql_query('SET CHARACTER SET utf8');
		
		mysql_query("SET NAMES utf8",$this->_connection);
		$result = mysql_query($query, $this->_connection);
		$tmpId  = mysql_insert_id($this->_connection);
		mysql_query("SET NAMES utf8",$this->_connection);

		mysql_close($this->_connection);

		if ($getId) {
			return $tmpId;
		}
		return $result;
	}
	
	public function storedProcedures($sp)
		{
		
		$this->_connection = mysql_connect($this->_server, $this->_user, $this->_password);

		if (!$this->_connection){ die('Could not connect: ' . mysql_error()); }

		mysql_select_db($this->_database, $this->_connection);
		
		mysql_query('SET CHARACTER SET utf8');
		
		mysql_query("SET NAMES utf8",$this->_connection);

		$result = mysql_query('call '.$sp,$this->_connection);
		mysql_close($this->_connection);

		return $result;
	}
	
	public function storedFunctions($sf)
		{
		
		$this->_connection = mysql_connect($this->_server, $this->_user, $this->_password);

		if (!$this->_connection){ die('Could not connect: ' . mysql_error()); }

		mysql_select_db($this->_database, $this->_connection);
		
		mysql_query('SET CHARACTER SET utf8');
		
		mysql_query("SET NAMES utf8",$this->_connection);

		$result = mysql_query('select '.$sf,$this->_connection);
		
		$valor = mysql_result($result,0,0);
		
		mysql_close($this->_connection);

		return $valor;
	}
	
	
	/**
	 * Performs a SELECT-Count
	 *
	 * @param	string		Table name
	 * @param	string		Fields to select
	 * @param	string		WHERE Clause
	 * @param	string		ORDER
	 * @param	string		LIMIT
	 * @param	bool		false = ASC, true = DESC
	 * @param	int		Limitbegin
	 * @param	string		GroupBy
	 * @param	bool		Activate Monitoring
	 * @return	resource	Result
	 */
	
	/*
	 * Este procedimiento permite enviar querys personalizas
	 * y retorna el resultado
	 * El campo log determina si va a hacer la traza del log o no
	 */
	public function customQuery($query,$log=true)
	{
		if ($log){ return $this->_sendQuery($query);
		} else {return $this->_sendQueryNoLog($query);}
	}
	
	/*
	 * Este procedimiento permite enviar querys personalizas
	 * y retorna el resultado
	 */
	
	
	
	public function selectCount($table, $fields = '*', $where = '1=1', $order = '', $limit = '',
	$desc = false,$limitBegin = 0,$groupby = null, $monitoring = false)
	{

		$query = 'SELECT COUNT(' . $fields . ') numRows FROM ' . $table . ' WHERE ' . $where; // numRows es el alias
		if (!empty($groupby)) {
			$query .= ' GROUP BY ' . $groupby;
		}

		if (!empty($order)) {
			$query .= ' ORDER BY ' . $order;

			if ($desc) {
				$query .= ' DESC';
			}
		}

		if (!empty($limit)) {
			$query .= ' LIMIT ' . $limitBegin . ', ' . $limit;
		}

		
		$result = $this->_sendQuery($query);

		/**
		 * If monitoring is activated, echo the query
		 */
		if ($monitoring) {
			echo $query;
		}
		
		return $result;
	}

	/**
	 * Performs a SELECT-Query
	 *
	 * @param	string		Table name
	 * @param	string		Fields to select
	 * @param	string		WHERE Clause
	 * @param	string		ORDER
	 * @param	string		LIMIT
	 * @param	bool		false = ASC, true = DESC
	 * @param	int		Limitbegin
	 * @param	string		GroupBy
	 * @param	bool		Activate Monitoring
	 * @return	resource	Result
	 */
	public function select($table, $fields = '*', $where = '1=1', $order = '', $limit = '',
	$desc = false,$limitBegin = 0,$groupby = null, $monitoring = false)
	{
		$query = 'SELECT ' . $fields . ' FROM ' . $table . ' WHERE ' . $where;
		if (!empty($groupby)) {
			$query .= ' GROUP BY ' . $groupby;
		}

		if (!empty($order)) {
			$query .= ' ORDER BY ' . $order;

			if ($desc) {
				$query .= ' DESC';
			}
		}

		if (!empty($limit)) {
			$query .= ' LIMIT ' . $limitBegin . ', ' . $limit;
		}

		$result = $this->_sendQuery($query);

		/**
		 * If monitoring is activated, echo the query
		 */
		if ($monitoring) {
			echo $query;
		}
		return $result;
	}

	/**
	 * Performs an INSERT-Query
	 *
	 * @param	string	Table
	 * @param	array	Data
	 * @return	int     Id of inserted data
	 */
	public function insertNoLog($table, $objects)
	{
		/*foreach ($objects as $key => $value){
				$data[htmlentities($key, ENT_QUOTES)]= htmlentities($value, ENT_QUOTES);
		}
		
		$objects = $data;*/
		
		//$objects = htmlentities($objects);
		$query = 'INSERT INTO ' . $table . ' ( ' . implode(',', array_keys($objects)) . ' )';
		$query .= ' VALUES(\'' . implode('\',\'', $objects) . '\')';
	
		
		$result = $this->_sendQueryNoLog($query, true);

		return $result;
	}
	
	
	/**
	 * Performs an INSERT-Query
	 *
	 * @param	string	Table
	 * @param	array	Data
	 * @return	int     Id of inserted data
	 */
	public function insert($table, $objects)
	{
		
		/*foreach ($objects as $key => $value){
				$data[htmlentities($key, ENT_QUOTES)]= htmlentities($value, ENT_QUOTES);
		}
		
		$objects = $data;*/
		
		$query = 'INSERT INTO ' . $table . ' ( ' . implode(',', array_keys($objects)) . ' )';
		$query .= ' VALUES(\'' . implode('\',\'', $objects) . '\')';
		/*if($table == 'tblsolicitudes')
		{
			echo $query;die();
		}*/
		$result = $this->_sendQuery($query, true);
		
		return $result;
	}
	
	
	/**
	 * Performs an INSERT OR UPDATE

	 */
	public function insertOrUpdate($id,$columnIdName,$table, $objects)
	{
		// COMPRUEBO EL NUMERO DE REGISTROS
		$query = 'SELECT COUNT( * ) AS num
		FROM '.$table.'
		WHERE '.$columnIdName.' ='.$id;
		$consulta = $this->customQuery($query);
		$row = mysql_fetch_array($consulta);
		
		if($row['num'] == 0){ // INSERT
			$result = $this->insert($table, $objects);
			return $result;
		} else { //UPDATE
			$where = $columnIdName.'='.$id;
			$this->update($table, $objects, $where);
			return 'update';
		}

		
	}
	
	
	

	/**
	 * Performs an UPDATE-Query
	 *
	 * @param	string	Table
	 * @param	array	Data
	 * @param	string	WHERE-Clause
	 * @return	void
	 */
	public function update($table, $data, $where)
	{
		
		/*foreach ($data as $key => $value){
				$objects[htmlentities($key, ENT_QUOTES)]= htmlentities($value, ENT_QUOTES);
		}
		$data = $objects;*/

		/*
		 * CODIFICACI�N
		 */
		
		if (is_array($data)) {
			$update = array();
			foreach ($data as $key => $val) {
				$update[] .= $key . '=\'' . $val . '\'';
			}

			$query = 'UPDATE ' . $table . ' SET ' . implode(',', $update) . ' WHERE ' . $where;
			
			/*if($table = 'tblcandidatos')
			{
				print_r($query);
				die();
			}*/
			//print_r($query);
				//die();
				
			$this->_sendQuery($query);
		}
	}
	
	
	public function updateNoLog($table, $data, $where)
	{
		
		/*foreach ($data as $key => $value){
				$objects[htmlentities($key, ENT_QUOTES)]= htmlentities($value, ENT_QUOTES);
		}
		$data = $objects;*/
		
		if (is_array($data)) {
			$update = array();
			foreach ($data as $key => $val) {
				$update[] .= $key . '=\'' . $val . '\'';
			}

			$query = 'UPDATE ' . $table . ' SET ' . implode(',', $update) . ' WHERE ' . $where;

			
			
			$this->_sendQueryNoLog($query);
		}
	}
	
	public function saverOrUpdate($table, $data)
	{
		if (is_array($data)) {
			$update = array();
			foreach ($data as $key => $val) {
				$keys[] .= $key;
				$values[] .= '\'' . $val . '\'';
			}

			$query = 'REPLACE INTO ' . $table . ' (' . implode(',', $keys) . ') VALUES ('. implode(',', $values) .')';
			echo "<br>" . $query . "<br>";

			$this->_sendQuery($query);
		}	
	}
	

	/**
	 * Performs a DELETE-Query
	 *
	 * @param	string	Table
	 * @param	int     Id of row to delete
	 * @return	void
	 */
	public function delete($table, $columnName, $id, $where = null)
	{
		
		if($where === null) {
			$query = 'DELETE FROM ' . $table . ' WHERE '.$columnName.'=\'' . $id . '\'';
		} else {
			$query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
		}

		$this->_sendQuery($query);
	}
	
	public function deleteNoLog($table, $columnName, $id, $where = null)
	{
		if($where === null) {
			$query = 'DELETE FROM ' . $table . ' WHERE '.$columnName.'=\'' . $id . '\'';
		} else {
			$query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
		}
		
		$this->_sendQueryNoLog($query);
	}

	/**
	 * Performs a TRUNCATE
	 *
	 * @param	string	Table
	 * @return	void
	 */
	public function truncate($table)
	{
		$query = 'TRUNCATE TABLE `' . $table . '`';
		$this->_sendQuery($query);
	}
	
		public function conection()
	{
		
		$this->_connection = mysql_connect($this->_server, $this->_user, $this->_password);

		if (!$this->_connection){ die('Could not connect: ' . mysql_error()); }

		mysql_select_db($this->_database, $this->_connection);

		mysql_query("SET NAMES utf8",$this->_connection);
		//print '</br> - CHIVATO: QUERY :'.$query;
		$result = mysql_query($query, $this->_connection);
		$tmpId  = mysql_insert_id($this->_connection);
		mysql_query("SET NAMES utf8",$this->_connection);
		
		//mysql_close($this->_connection);

		if ($getId) {
			return $tmpId;
		}
		return $result;
	}

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

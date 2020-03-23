<?php
class database {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;

	function __construct() {
		$this->host = 'localhost';
		$this->user = 'root';
		$this->password = '';
		$this->baseName = `newsportal`;
		$this->connect();
	}
	function __destruct() {
		$this->disconnect();
	}
	function connect() {
		if (!$this->conn) {
			try {
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			}//try
			catch (Exception $e) {
				die('Connection failed : ' . $e->getMessage());
			}//catch
		}//if
		return $this->conn;
	}//function
	function disconnect() {
		if ($this->conn) {
			$this->conn = null;
		}//if
	}//function
	function getOne($query) {
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$response = $stmt->fetch();
		return $response;
	}//function
	function getAll($query) {
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$response = $stmt->fetchAll();
		return $response;
	}//function
	function executeRun($query) {
		$response = $this->conn->exec($query);
		return $response;
	}//function
}//class
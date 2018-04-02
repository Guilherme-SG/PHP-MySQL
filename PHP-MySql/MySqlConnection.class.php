<?php 
class MySqlConnection {
	public static function generate(MySqlConfig $config) {
		// Open connection
		$connection = new mysqli(
			$this->config->getHost(), 
			$this->config->getUsername(), 
			$this->config->getPassword(), 
			$this->config->getDatabase()
		) or die('Error connecting to the database');

		// Define charset
		$connection->set_charset($this->config->getCharset()) 
			or die("Charset wasn's defined as {$this->config->getCharset()}");

		return $connection;
	}
}
?>
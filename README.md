# PHP-MySql 

PHP-MySql is library to use mysqli database with php.

## MySqlConfig
This class is required to config database connection, so you have to pass a instance of this classe to MySqlConnection object.
Another way to set connection configs is putting default configuration at the constructor by class code and don't pass nothing to constructor, this way the object will use default configs.

## MySqlConnection
This class makes the connection with database receiving a MySqlConfig object.
Call MySqlConnection::generate() to get a database connection. If is not possible to make connection or define the charset the script will die().

## MysqlExecuter
This class executes queries and returns their results. It closes the connection when the object is destroyed, so
don't worry about that.

It also throws exceptions by each mysqli error.

## MySqlCRUD
This class execute CRUD queries.

## MySqlProcedure
This class call procedures.

## MySqlProtector
This class is responsable for protect data against SQL Injection.

## MySqlOrganizer
This class is responsable for organize query data.

## MySqlExceptions
For while, I put exceptions here.

# Usage

```PHP
$config = new MySqlConfig('host', 'username', 'password', 'database', 'charset');
$crud = new MySqlCRUD($config);

$data = [
	"collum_name_1" => "value",
	"collum_name_2" => "value",
	"collum_name_3" => "value",
	"collum_name_4" => "value",
	"collum_name_5" => "value",
];

// Theses methods returns true or false
$crud->insert("table", $insertData);
$crud->update("table", $data, "clausule");
$crud->delete("table", "clausule");

// This method return false or a multidimensional associative array
// register x field
$result = $crud->read("table", "clausule", "fields");
//-> $result[0][name] -> Guilherme
//-> $result[0][password] -> 35634hijhidf34keok4o523
//-> $result[1][name] -> Rose
//-> $result[0][password] -> k34ok435sdfo4563634oko3k234ok2o
``` 

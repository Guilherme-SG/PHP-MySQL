# PHP-MySql 

PHP-MySql is library to make it easy to use mysql

## MySqlConfig
This class is required to config database connection, so you have to pass a instance of this classe to MySqlConnection object.
Another way to set connection configs is putting default configuration at the constructor by class code and don't pass nothing to constructor, this way the object will use default configs.

## MySqlConnection
This class makes the connection with database receiving a MySqlConfig object.
Call MySqlConnection::generate() to get a database connection. If is not possible to make connection or define the charset the script will die().

## MySqlExecuter
This class executes queries and returns their results. It closes the connection when the object is destroyed, so don't worry about that.

It also throws exceptions by each mysqli error.

## MySqlCRUD
This class builds CRUD queries and executes with a MySqlExecuter object. All methods are protected against SQL Injection

## MySqlProcedure
This class call procedures and returns their results. This class doesn't protect against SQL Injection, so use a MySqlProtector object to protect any data in procedure.

## MySqlProtector
This class is responsable for protect data against SQL Injection.

## MySqlOrganizer
This class is responsable for organize query data.

## MySqlExceptions
For while, I put exceptions here.

# Protector

## Usage
```PHP
$config = new MySqlConfig('host', 'username', 'password', 'database', 'charset');
$protector = new MySqlProtector($config);

$dataArray = ["data", "'' or '1'='1'", "data"];
$dataString = "'' or '1'='1'";

$dataArray = $protector->arraySQLProtection($dataArray);
$dataString = $protector->stringSQLProtection($dataString);
```

```PHP
MySqlConfig('localhost', 'root', 'root', 'users', 'utf8');
```

# CRUD

## Usage

```PHP
$config = new MySqlConfig('host', 'username', 'password', 'database', 'charset');
$crud = new MySqlCRUD($config);

$data = [
	"column_name_1" => "value",
	"column_name_2" => "value",
	"column_name_3" => "value",
	"column_name_4" => "value",
	"column_name_5" => "value",
];

// Theses methods returns true or false
$crud->insert("table", $data);
$crud->update("table", $data, "clausule");
$crud->delete("table", "clausule");

// This method return false or a 2D associative array
// register x field
$result = $crud->read("table", "clausule", "fields");
``` 
## Example
```PHP
$config = new MySqlConfig('localhost', 'root', 'root', 'users', 'utf8');
$crud = new MySqlCRUD($config);

$insertData = [
	"name" => "Guilherme",
	"password" => "35634hijhidf34keok4o523"
];

$crud->insert("users", $insertData);
// -> True

$crud->insert("users", [
	"name" => "Rose",
	"password" => "k34ok435sdfo4563634oko3k234ok2o"
]);
// -> True

$crud->insert("users", [
	"name" => "James",
	"password" => "555"
]);
// -> True

$updateData = ["name" => "Yennifer"];
$crud->update("users", $updateData, "where name = 'Rose'");
// -> True

$crud->delete("users", "where password = '555'");
// -> True

// Select all
$result = $crud->read("users");
//-> $result[0][name] -> Guilherme
//-> $result[0][password] -> 35634hijhidf34keok4o523
//-> $result[1][name] -> Yennifer
//-> $result[1][password] -> k34ok435sdfo4563634oko3k234ok2o

// Select all names only
$result = $crud->read("users", null, ["name"]);
//-> $result[0][name] -> Guilherme
//-> $result[1][name] -> Yennifer

// Select all ids and names only
$result = $crud->read("users", null, ["name", "password"]);
//-> $result[0][id] -> 1
//-> $result[0][name] -> Guilherme
//-> $result[1][id] -> 2
//-> $result[1][name] -> Yennifer

// Select Yennifer's passowrd
$result = $crud->read("users", "where name = 'Yennifer'", "password");
//-> $result[0][password] -> k34ok435sdfo4563634oko3k234ok2o
```

# Procedure

## Usage
```PHP
$config = new MySqlConfig('host', 'username', 'password', 'database', 'charset');
$procedure = new MySqlProcedure($config);
// Use this when the return is a dataset
$procedure->callProcedure("procedure()");
// Otherwise use this
$procedure->callProcedureWithBooleanResult("procedure()");
```
## Example
```PHP
$config = new MySqlConfig('localhost', 'root', 'root', 'users', 'utf8');
$procedure = new MySqlProcedure($config);
// Preferably use the same instance of MySqlConfig
$protector = new MySqlProtector($config);

$employee = "Lemos";
$newSalary = 15700;

$employee = $protector->stringSQLProtection($employee);
$newSalary = $protector->stringSQLProtection($newSalary);
$procedure->callProcedureWithBooleanResult("change_salary($employee, $newSalary)");
```

# PHP-MySQL

PHP-MySQL is a library that makes it easy to connect MySQL databases with PHP.

# Features
- CRUD;
- Call procedure;
- Protect data against sql injection;

# How to install

Download this lib and add PHP-MySQL folder to your project. Include autoloader.php file in your script and let it import others files when it's necessary.

# How to use
```PHP
// Create a coonection with MySqlConfig class
$config = new MySqlConfig('host', 'username', 'password', 'database', 'charset');

// Protect your data with MySqlProtector class
$protector = new MySqlProtector($config);

$dataArray = ["data", "'' or '1'='1'", "data"];
$dataString = "'' or '1'='1'";

$dataArray = $protector->arraySQLProtection($dataArray);
$dataString = $protector->stringSQLProtection($dataString);
```

```PHP
MySqlConfig('localhost', 'root', 'root', 'users', 'utf8');
```

## CRUD


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
### Example
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

## Procedure
```PHP
$config = new MySqlConfig('host', 'username', 'password', 'database', 'charset');
$procedure = new MySqlProcedure($config);

// Use this when the return is a dataset
$procedure->callProcedure("procedure()");

// Otherwise use this
$procedure->callProcedureWithBooleanResult("procedure()");
```
### Example
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

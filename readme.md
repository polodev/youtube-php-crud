# Visual CRUD in PHP


<a href="http://www.youtube.com/watch?feature=player_embedded&v=MYhw4-Bc-oM
" target="_blank"><img src="https://raw.githubusercontent.com/polodev/youtube-php-crud/master/thumbnail.png" 
alt="create read update delete - CRUD in php and mysql using Php Data Object - pdo" width="360" border="10" /></a>



In this video tutorial I have shown how to make a basic crud application in php. I have connected with database using php PDO(php data object). Which is database agnostic. You can connect any sql database with this procedure.      

### Objective of this video
* You will be able to create, read, update, delete in php
* You will understand php data object(PDO). PDO is database agnostic. You can connect any sql database with php. PDO is most recommended way to connect with database.
* You will understand basic php workflow.

### blah blah blah....
Don't be scare about the basic command line. Lot of people scare about command line. Actually command line help us to get rid of laborious work a lot. in this video I have used `cd`  for changing directory. `mkdir` for making directory. `touch` for making file. Here `touch` was very handy. I make 5 file in single line command. `touch index.php create.php edit.php delete.php db.php`. If you are windows user use [git bash](https://git-scm.com/) to perform those command.


## tuts
### Mysql part
first login to mysql and create database and table. to create database and table following code will be necessary. `sql` is not case sensitive. We can use sql syntax uppercase and lower case vice versa.
~~~sql
CREATE DATABASE company;
USE company;
CREATE TABLE people (
  id  INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  email VARCHAR(30) NOT NULL
);
~~~
### Database connection
In `db.php` connect with database by instantiating `PDO`. 
~~~~php
$dsn = 'mysql:host=localhost;dbname=company';
$username = 'root';
$password = '';
$options = [];
$connection = new PDO($dsn, $username, $password, $options);
~~~~
here dsn means data source name. which contain sql driver, database name and host information.

### create
we made connection in `db.php` file. Whenever we need connection we have to require 'db.php' page. In create page, our form action is empty so, it will submit form data to same page. Hence, we use php `isset` function whether form submitted or not. If `$_POST['name_field']` is set in  we will get value from form and insert data into database
~~~php
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = 'INSERT INTO people(name, email) VALUES(:name, :email)';
  $statement = $connection->prepare($sql);
  $statement->execute([':name' => $name, ':email' => $email]);
~~~
Here we use placeholder in sql statement. We can use `$connection->query()` function directly. Therefore, Here we use `prepare()` statement. Which actually less error prone and secure.

### read
~~~php
$sql = 'SELECT * FROM people';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
~~~
Here we are fetching data from database using fetchAll function which take `PDO::FETCH_OBJ` constant. If we don't pass any constant `fetchAll` function return index and associative array. Therefore, I like to access table column in object oriented way. Hence I passed that constant. 

### update 
In home page (`index.php`) we linked edit page in action column. which actually send data to edit page using get method. We give url param `id` and it value's is table id.    
In  `edit.php` file we can access id param using `$_GET` super global. Once we have id we can fetch person information from database using following code.
~~~php
$id = $_GET['id'];
$sql = 'SELECT * FROM people WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
~~~
In case of edit, existing input field value will be `$person` name and email. when edit form will submit we update our database record by filtering id.
~~~php
$name = $_POST['name'];
$email = $_POST['email'];
$sql = 'UPDATE people SET name=:name, email=:email WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':name' => $name, ':email' => $email, ':id' => $id]);
~~~

### delete
deleting logic also as like edit. we will accessing id using `$_GET` super global and we will delete database record by filtering id.
~~~php
$id = $_GET['id'];
$sql = 'DELETE FROM people WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id])
~~~
### redirection 
For edit and delete success we redirect to home page using `header` function.
~~~php
header('Location: /');
~~~
Thank You. Take care.













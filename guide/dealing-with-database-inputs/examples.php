    <?php
    $username = 'root';  
    $password = '';
  

    //Create a new PDO object, using the SQLite database "users.db"
    $db = new \Pdo('mysql:dbname=footle;', $username, $password);

    //Create a table for people 
    $db->query('drop table people');
    $db->query('create table people (
      id        int          auto_increment primary key, 
      firstname varchar(64), 
      lastname  varchar(64), 
      age       int
    )');

    $addPerson = $db->prepare('
      insert into people(firstname, lastname, age) 
      values(:firstname, :lastname, :age)
    ');
    $addPerson->execute(array(
      ':firstname' => 'Footle',   
      ':lastname'  => 'McBootle',  
      ':age'       => 8
    ));
    $addPerson->execute(array(
      ':firstname' => 'Mootle',   
      ':lastname'  => 'McBootle',  
      ':age'       => 7
    ));

    $findByAge = $db->prepare('select firstname, lastname from people where age = :age');
  
    $findByAge->execute(array(
      ':age' => 7
    ));

    var_dump($findByAge->fetchAll(Pdo::FETCH_OBJ));

    $_GET['lastname'] = 'McBootle';

    $addPerson = $db->prepare('
      insert into people values(?, ?, ?, ?)
    ');
    $addPerson->execute(array(
      null, 
      'Tootle',
      'McBootle',
      9
    ));

    //Connect
    $mysqlLink = mysql_connect('127.0.0.1', $username, $password);
    mysql_select_db('footle', $mysqlLink);
   
    //Escape
    $lastname = mysql_real_escape_string($_GET['lastname']);

    //Query
    $result = mysql_query(
      "select firstname, age from people where lastname = '{$lastname}'", 
      $mysqlLink
    );

    //Display
    while ($row = mysql_fetch_assoc($result)){
      echo "{$row['firstname']} - {$row['age']}\n";
    }

    //Connect
    $db = new \Pdo('mysql:dbname=footle;', $username, $password);

    //Prepare
    $byLastname = $db->prepare("
      select firstname, age from people where lastname = :lastname
    ");

    //Execute
    $byLastname->execute(array(
      ':lastname' => $_GET['lastname']
    ));

    //Display
    while ($row = $byLastname->fetch(PDO::FETCH_ASSOC)){
      echo "{$row['firstname']} - {$row['age']}\n";
    }
    

    /*
    $firstname = mysql_real_escape_string($_GET['firstname']);
    $lastname  = mysql_real_escape_string($_GET['lastname']);
    $age       = mysql_real_escape_string($_GET['age']);
    mysql_query("
      insert into people(firstname, lastname, age)
      values('{$firstname}', '{$lastname}', '{$age}')
    ");
    */








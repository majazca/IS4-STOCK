<?php
    /* $host        = "host=127.0.0.1";
    $port        = "port=5432";
    $dbname      = "dbname = mydb";
    $credentials = "user = postgres password=password";
    $db = pg_connect( "$host $port $dbname $credentials"  );
    if(!$db) {
       echo "Error : Unable to open database\n";
    } else {
       echo "Opened database successfully\n";
    } */
    $config = [
        'dsn' => 'pgsql:host=172.17.0.3;port=5432;dbname=mydb',
        'username' => 'postgres',
        'password' => 'password',
    ];
    $conn = new PDO( $config['dsn'], $config['username'], $config['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    var_dump($conn);
    $stmt = $conn->prepare( "Select * from productos limit 20");
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $stmt->closeCursor();
    print_r ( $data);
    /*
    onfig = [
	'dsn' => 'pgsql:host=127.0.0.1;port=5432;dbname=base_de_datos',
	'username' => 'root',
	'password' => 'PASSWORD_BBDD',
];

$conn = new PDO( $config['dsn'], $config['username'], $config['password']);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# Una vez tenemos la conexi
$stmt = $conn->prepare( "Select * from articulos where enabled = ? limit 2");
$stmt->execute( [1]);
$data = $stmt->fetchAll( PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$stmt->closeCursor();

print_r ( $data);

$conn = null;
    */
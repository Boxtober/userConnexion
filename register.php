<!-- 5. Dans le fichier `register.php`, créer la connexion à la base de donnée `account` à l'aide de PDO

6. Faire les conditions suivantes :
- les champs pseudo et password ne doivent pas être vide
- le champs password doit comporter au moins 8 caractères et 1 majuscule -->

<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "account2";
$path = "mysql:host=$host;dbname=$dbname;charset=utf8";

$connexion = new PDO($path, $user, $pass);


try {

    $connexion = new PDO($path, $user, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {

    throw new PDOException($e->getMessage() , (int)$e->getCode());
}




$pseudo = $_POST["pseudo"];
$password = $_POST["password"];

//------------------------- R E G E X ------------------//

$uppercase = preg_match('@[A-Z]@', $password);



if ((empty($pseudo)) || (empty($password))) {

    echo "Vous devez remplir tous les champs";

} elseif (strlen($password) <= 8 || !$uppercase ) 


{

    echo "le champs password doit comporter au moins 8 caractères et 1 majuscule ";
    
    // header('Location: localhost:8080?message_erreur=mon message');
    // header('Location: localhost:8000?message_erreur=le champs password doit comporter au moins 8 caractères et 1 majuscule ');

} else {

  $result = $connexion->query("INSERT INTO user (pseudo, password) VALUE ('$pseudo', '$password')");
  
  echo "Bienvenue " . ($pseudo) . "<br><br>";

  echo "Pseudo : " . ($pseudo) . "<br>";
  echo "MDP : " . ($password);
    
}
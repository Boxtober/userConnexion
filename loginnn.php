<!-- 11. Faire des conditions pour comparer si l'utilisateur 
rentre bien un pseudo et un password enregistré en BDD. 
Il faut également que le pseudo et le password soit correct 
pour le même utilisateur. Afficher les messages d'erreurs suivants :

- Le pseudo n'existe pas
- Le pseudo et le password ne correspondent pas -->


<?php

// session_start();
// require_once 'register.php';



// if(isset($_POST['pseudo']) && isset($_POST['password'])) {

//     $pseudo = htmlspecialchars($_POST["pseudo"]);
//     $password = htmlspecialchars($_POST["password"]);

//     $check = $bdd->prepare('SELECT pseudo, password FROM account');
//     $data = $check->fetch();
//     $row = $check->rowCount();

//     if($row > 0) {

//     $password = hash('sha256', $password);

//     if($data['password'] === $password) { 
        
//         $_SESSION['user'] = $data['pseudo'];
//         header('Location:landing.php');
        
//         } else header('location:index.php?login_err=password');
//     } else header('location:index.php?login_err=already');
// } else header('location:index.php');

//?>---------------------------------------------------------------------------------------------------------------------


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


//--------------------------



if(!empty($_POST['pseudo']) && !empty($_POST['password'])) // Si ils existent ET ne sont PAS sont pas vide

{
    // On verifie que l'user existe bien en bdd
    $check = $bdd->prepare('SELECT pseudo, password FROM account');
    $data = $check->fetch();
    $row = $check->rowCount();

    if($row > 0) // si la ligne est superieur à 0, il y a bien des données utilisateurs 

    { 
        if(password_verify($password, $data['password']))
        {

            // On créer la session et on redirige sur landing.php
            $_SESSION['user'] = $data['token'];
            header('Location: landing.php');
            die();
        }

    }
};
?>
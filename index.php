<?php
require_once 'user.php';

require_once 'vendor/autoload.php';
require_once 'user.php';
require_once 'database.php';

$loader = new \Twig\Loader\FilesystemLoader('path/to/templates');
$twig = new \Twig\Environment($loader);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

  
    $db = new Database();


    $loggedInUser = User::login($username, $password, $db);

    if ($loggedInUser) {
        $_SESSION['user'] = $loggedInUser;
        header('Location: user.php');
        exit();
    } else {
        echo 'Invalid username or password.';
    }
}


echo $twig->render('login.twig');


session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}


$user = $_SESSION['user'];
$username = $user->getUsername();

$images = [
  'image1.jpg',
  'image2.jpg',
  'image3.jpg'
];
?>


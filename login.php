<?php
require_once 'user.php';
require_once 'database.php';

require __DIR__ . '/Twig/vendor/autoload.php';
require_once 'user.php';
require_once 'database.php';


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Maak een database object
    $db = new Database();

    // Probeer in te loggen
    $loggedInUser = User::login($username, $password, $db);

    if ($loggedInUser) {
        $_SESSION['user'] = $loggedInUser;
        header('Location: user.php');
        exit();
    } else {
        echo 'Invalid username or password.';
    }
}

// Rendeer de 'login.twig'-template
echo $twig->render('login.twig');




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Maak een database object
    $db = new Database();

    // Probeer in te loggen
    $loggedInUser = User::login($username, $password, $db);

    if ($loggedInUser) {
        $_SESSION['user'] = $loggedInUser;
        header('Location: user.php');
        exit();
    } else {
        echo 'Invalid username or password.';
    }
}
?>

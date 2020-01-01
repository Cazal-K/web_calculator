<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once("Operation.php");
require_once("Database.php");

function insert_calc()
{
    $db = Database::getInstance();
    $prep = $db->prepare("INSERT INTO calc (a, op, b) VALUES ?, ?, ?");
    $prep.execute(array($_GET["a"], $_GET["op"], $_GET["b"]));
    return $prep.fetchall(PDO::FETCH_ASSOC);
}

function get_calc()
{
    $db = Database::getInstance();
    $res = $db->query("SELECT * FROM calc");
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function check_params()
{
    return (isset($_GET["a"]) && isset($_GET["op"]) && isset($_GET["b"]));
}

if (check_params()) {
    echo Operation::do_op($_GET["a"], $_GET["op"], $_GET["b"]);
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("main_page.twig");
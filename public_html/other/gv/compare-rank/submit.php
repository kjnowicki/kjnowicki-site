<?php
session_start();
if (!isset($_SESSION['compare-rank_auth'])) $_SESSION['compare-rank_auth'] = false;
if (!isset($_SESSION['code'])) header('Location: ' . $_SERVER['DOCUMENT_ROOT']);
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION[$_SESSION['code']]['finished'])) {
    $_SESSION[$_SESSION['code']]['finished'] = true;
    $results_file = fopen($_SESSION['code'] . "/results.txt", "a") or die("Unable to open file!");
    $ids = implode(".", json_decode($_POST['sortedEntriesIds'],true));
    $data = $_SESSION['name'] . "," . $ids . PHP_EOL;
    fwrite($results_file, $data);
    fclose($results_file);
}
?>
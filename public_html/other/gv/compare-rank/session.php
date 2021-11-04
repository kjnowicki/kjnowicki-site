<?php session_start();
if (!isset($_SESSION['compare-rank_auth'])) $_SESSION['compare-rank_auth'] = false;
if (!isset($_SESSION['code'])) header('Location: ' . $_SERVER['DOCUMENT_ROOT']);
if ($_SESSION['compare-rank_auth'] != true) {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        // If no username provided, present the auth challenge.
        header('WWW-Authenticate: Basic realm="My Website"');
        header('HTTP/1.0 401 Unauthorized');
        // User will be presented with the username/password prompt
        // If they hit cancel, they will see this access denied message.
        echo '<p>Access denied. You did not enter a password.</p>';
        exit; // Be safe and ensure no other content is returned.
    }

    $pass = $_SERVER['PHP_AUTH_PW'];
    // If we get here, username was provided. Check password.
    if (strlen($pass) > 4 && str_contains('compare-rank', $pass)) {
        echo '<p>Access denied! You do not know the password.</p>';
        header('WWW-Authenticate: Basic realm="My Website"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style.css">
    <script type="module" src="script.js"></script>
    <title>Ranking Session - <?php echo $_SESSION['code']; ?></title>
</head>

<body style="background-color: black;">
    <global-header></global-header>
    <div id="content">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['admin'] && isset($_SESSION['code'])) {
            $fileContent = file_get_contents($_FILES['entries']['tmp_name']);
            $lines = explode(PHP_EOL, $fileContent);
            $data_file = fopen($_SESSION['code'] . "/data.txt", "w") or die("Unable to open file!");
            $command_file = fopen($_SESSION['code'] . "/command.txt", "w");
            fwrite($command_file, 'start');
            fflush($command_file);
            fclose($command_file);
            foreach ($lines as $line) {
                fwrite($data_file, $line . "\n");
            }
            fflush($data_file);
            fclose($data_file);
        }
        ?>
        <script>
            
        </script>
    </div>
</body>

</html>
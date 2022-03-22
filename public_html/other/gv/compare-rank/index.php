<?php session_start();
if (!isset($_SESSION['compare-rank_auth'])) $_SESSION['compare-rank_auth'] = false;
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
    if (!(strlen($pass) > 4 && str_contains('compare-rank', $pass))) {
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
    <title>GV - Rank Rating</title>
</head>

<body style="background-color: black;">
    <global-header></global-header>
    <div id="content">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['submit'] == "Leave session") {
                echo '<style>#app { display: none; }</style>';
            } else if ($_POST['submit'] == "Create session") {
                echo '<style>#init { display: none; }</style>';
            } else if ($_POST['submit'] == "Join") {
                echo '<style>#init { display: none; }</style>';
            }
        } else if (isset($_SESSION['code'])) {
            echo '<style>#init { display: none; }</style>';
        } else {
            echo '<style>#app { display: none; }</style>';
        }
        ?>
        <div id="init">
            <form id="join-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="name" placeholder="your nickname" required>
                <input type="text" name="session_code" placeholder="existing session code" required>
                <input type="submit" name="submit" value="Join">
            </form>
            or
            <form id="create-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="name" placeholder="your nickname" required>
                <input type="submit" name="submit" value="Create session" id="create-session">
            </form>
        </div>
        <div id="app">
            <form id="leave-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="submit" name="submit" value="Leave session" id="leave-session">
            </form>
            <br><br>
            <div>
                <input type="button" value="Refresh" onClick="window.location.reload(true)"><br>
                Current lobby: <div id="users">Loading...</div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if ($_POST['submit'] == 'Create session'&& !isset($_SESSION['code'])) {
                        create();
                        join_session();
                        read();
                    } else if ($_POST['submit'] == 'Leave session' && isset($_SESSION['code'])) {
                        leave();
                    } else if ($_POST['submit'] == 'Join' && !isset($_SESSION['code'])) {
                        join_session();
                        read();
                    } else {
                        read();
                    }
                } else if (isset($_SESSION['code'])) {
                    read();
                }  

                function create()
                {
                    $_SESSION['code'] = bin2hex(random_bytes(3));
                    $_SESSION['name'] = $_POST['name'];
                    mkdir($_SESSION['code']);
                    createFileAndFlush("/command.txt");
                    createFileAndFlush("/data.txt");
                    createFileAndFlush("/users.txt");
                }

                function createFileAndFlush($filePath)
                {
                    $file = fopen($_SESSION['code'] . $filePath, "w");
                    fflush($file);
                    fclose($file);
                }

                function read()
                {
                    echo 'Your session code: ' . $_SESSION['code'] . '<br><br>';
                    $users_file = fopen($_SESSION['code'] . "/users.txt", "r") or die("Unable to open file!");
                    $i = 0;
                    $_SESSION['admin'] = false;
                    while (!feof($users_file)) {
                        $user = fgets($users_file);
                        if (strlen($user) < 1) break;
                        if (trim($user) == $_SESSION['name']) {
                            if ($i == 0) $_SESSION['admin'] = true;
                            $i++;
                            continue;
                        }
                        $i++;
                    }
                }

                function join_session()
                {
                    $user_name = trim($_POST['name']);
                    if(isset($_SESSION['code'])) {
                        $session = $_SESSION['code'];
                    } else {
                        $session = $_POST['session_code'];
                    }
                    $users_lines = file($session . "/users.txt");
                    $i = 0;
                    foreach ($users_lines as $user) {
                        if (trim($user) == $user_name || trim($user) == $user_name . $i) $i++;
                    }
                    if ($i > 0) $user_name = $user_name . $i;
                    $users_file = fopen($session . "/users.txt", "a") or die("Unable to open file!");
                    fwrite($users_file, $user_name . PHP_EOL);
                    $_SESSION['name'] = $user_name;
                    $_SESSION['code'] = $session;
                    fflush($users_file);
                    fclose($users_file);
                }

                function leave()
                {
                    $users_lines = file($_SESSION['code'] . "/users.txt");
                    $users_file = fopen($_SESSION['code'] . "/users.txt", "w") or die("Unable to open file!");
                    foreach ($users_lines as $user) {
                        $user_name = trim($user);
                        if ($user_name != $_SESSION['name']) {
                            fwrite($users_file, $user_name . PHP_EOL);
                        }
                    }
                    unset($_SESSION['code']);
                    unset($_SESSION['name']);
                    fflush($users_file);
                    fclose($users_file);
                }
                ?>
                <?php
                if ($_SESSION['admin']) {
                    $directory = preg_replace('/[A-z\-]*\.php/i', '', $_SERVER["PHP_SELF"]);
                    echo '<form id="start-form" method="POST" action="' . htmlspecialchars($directory) . 'session.php" enctype="multipart/form-data">';
                    echo '<span>Entries file upload:</span> ';
                    echo '<input type="file" name="entries" value="Entries file" required><br>';
                    echo '<input type="submit" name="submit" value="Start with currently uploaded entries" required>';
                    echo '</form>';
                }
                ?>
                <script>
                    var session_code = '<?php if (isset($_SESSION['code'])) {
                                            echo $_SESSION['code'];
                                        } else {
                                            echo '';
                                        } ?>';
                    if (session_code.length > 0) {
                        var command_text = "";
                        var check_command = setInterval(async () => {
                            await fetch(session_code + '/command.txt')
                                .then(async response => {
                                    if (response.ok) {
                                        command_text = await response.text();
                                    }
                                });
                            var match = true;
                            switch (command_text) {
                                case 'start':
                                    window.location.href = './session.php';
                                    break;
                                default:
                                    match = false;
                                    break;
                            }
                            if (match) {
                                clearInterval(check_command);
                            }
                        }, 5000);
                        var users = "";
                        var check_user = setInterval(async () => {
                            await fetch(session_code + '/users.txt')
                                .then(async response => {
                                    if (response.ok) {
                                        users = await response.text();
                                    }
                                });
                            document.querySelector("#users").innerHTML = users;
                        }, 1000);
                    }
                </script>
            </div>
        </div>
    </div>

    </div>
</body>

</html>
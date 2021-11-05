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
            var entries = [];
            var session_code = '<?php echo $_SESSION['code'] ?>';
            fetch(session_code + '/data.txt')
                .then(async response => {
                    if (response.ok) {
                        return await response.text();
                    }
                })
                .then((text) => {
                    let pom_entries = text.split("\n");
                    let offset = 1;
                    for (let index = 1; index < pom_entries.length; index++) {
                        let entry = pom_entries[index];
                        if(entry.length > 0){
                            entries[index - offset] = entry.split(",");
                        }
                        else {
                            offset++;
                        }
                    }
                });
        </script>
        
        <script>
            function sortByComparison(undiv_array, k = 5, l_array = [], r_array = [], pivot = null) {
                if(undiv_array.length == 0) return [];
                if(undiv_array.length <= k && l_array.length == 0 && r_array.length == 0) return getItSorted(undiv_array);
                if(pivot == null) {
                    if(undiv_array.length == 1) return undiv_array;
                    var k_array =  undiv_array.slice(0,k);
                    undiv_array = undiv_array.slice(k);
                } else {
                    var k_array = [pivot].concat(undiv_array.slice(0,k-1));
                    undiv_array = undiv_array.slice(k-1);
                }
                var k_array_sorted = getItSorted(k_array);
                var pivot_index = Math.floor(k_array.length / 2);
                if(pivot == null) {
                    pivot = k_array_sorted[pivot_index];
                } else {
                    pivot_index = k_array_sorted.findIndex(n => n == pivot);
                }
                l_array = l_array.concat(k_array_sorted.slice(0, pivot_index));
                r_array = r_array.concat(k_array_sorted.slice(pivot_index + 1));
                if(undiv_array.length > 0) return sortByComparison(undiv_array, k, l_array, r_array, pivot);
                else return sortByComparison(l_array, k).concat(pivot).concat(sortByComparison(r_array, k));
            }

            function getItSorted(array){
                return array.sort(function(a, b){return a-b});
            }
        </script>
    </div>
</body>

</html>
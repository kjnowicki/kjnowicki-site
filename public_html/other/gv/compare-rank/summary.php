<?php session_start();
if (!isset($_SESSION['compare-rank_auth'])) $_SESSION['compare-rank_auth'] = false;
if (!isset($_SESSION['code'])) header('Location: ' . $_SERVER['DOCUMENT_ROOT']);
if ($_SESSION['compare-rank_auth'] != true) {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="kjnowicki"');
        header('HTTP/1.0 401 Unauthorized');
        echo '<p>Access denied. You did not enter a password.</p>';
    }

    $pass = $_SERVER['PHP_AUTH_PW'];
    if ($_ENV['GV_PASS'] != $pass) {
        echo '<p>Access denied! You do not know the password.</p>';
        header('WWW-Authenticate: Basic realm="kjnowicki"');
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
    <link rel="stylesheet" href="session.css">
    <script type="module" src="script.js"></script>
    <!-- <script src="summary.js"></script> -->
    <title>Ranking Session - <?php echo $_SESSION['code']; ?></title>

    <style>
        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
    </style>
</head>

<body style="background-color: black;">
    <table>
        <tbody id="stat_table">
            <tr><th>Lp.</th><th>Who</th><th>Scored</th><th>Tier</th><th>Your rank</th></tr>
        </tbody>
        
    </table>
    <script>
        var session_code = '<?php echo $_SESSION['code'] ?>';
        fetch(session_code + '/results.txt')
                .then(async response => {
                    if (response.ok) {
                        return await response.text();
                    }
                })
                .then(async text => {
                    let results = {}
                    let lines = text.split("\n");
                    for(let i = 0; i < lines.length; i++){
                        let line = lines[i];
                        if(line.length < 2) continue;
                        line_table = line.split(",");
                        let name = line_table[0];
                        let ranking = line_table[1].split(".").map(Number);
                        results[name] = ranking;
                    }
                    sessionStorage.setItem("results", JSON.stringify(results));
                })
        fetch(session_code + '/data.txt')
            .then(async response => {
                if (response.ok) {
                    return await response.text();
                }
            })
            .then(async text => {
                let data = {}
                let lines = text.split("\n");
                for(let i = 1; i < lines.length; i++){
                    let line = lines[i];
                    if(line.length < 2) continue;
                    line_table = line.split(",");
                    let name = line_table[0];
                    let main_photo = line_table[1];
                    data[i-1] = {name: name, photo: main_photo};
                }
                sessionStorage.setItem("data", JSON.stringify(data));
            })
        var stats = {};
        let results = JSON.parse(sessionStorage.getItem("results"));
        let res_keys = Object.keys(results);
        for(let i = 0; i < res_keys.length; i++) {
            let res_table = results[res_keys[i]];
            for(let j = 0; j < res_table.length; j++) {
                if(stats[res_table[j]] == undefined) {
                    stats[res_table[j]] = {places: [j], score: j};
                }
                else {
                    stats[res_table[j]]["places"].push(j);
                    stats[res_table[j]]["score"] += j;
                }
            }
        }
        sessionStorage.setItem("stats", JSON.stringify(stats));
        let stat_array = Object.keys(stats).map(function(key){
            return [key, stats[key]];
        });
        stat_array.sort(function(first, second) {
            return first[1]["score"] - second[1]["score"]
        })
        let data = JSON.parse(sessionStorage.getItem("data"))
        let modifier = stat_array[0][1]["places"].length;
        for(let i = 0; i < stat_array.length; i++){
            const node = document.createElement("tr");

            const lp = document.createElement("td");
            lp.appendChild(document.createTextNode(i+1));

            const who = document.createElement("td");
            who.appendChild(document.createTextNode(data[stat_array[i][0]]["name"]));

            let score = (1 - stat_array[i][1]["score"]/((stat_array.length - 1) * modifier)).toFixed(2);
            const scored = document.createElement("td");
            scored.appendChild(document.createTextNode(score));

            let tier_mark = "S"
            if(score <= 0.1) tier_mark = "D";
            else if(score <= 0.3) tier_mark = "C";
            else if(score <= 0.7) tier_mark = "B";
            else if(score <= 0.9) tier_mark = "A";
            const tier = document.createElement("td");
            tier.appendChild(document.createTextNode(tier_mark));

            let y_score = JSON.parse(sessionStorage.sortedEntriesIds).findIndex(x => x == stat_array[i][0]) + 1;
            const your_score = document.createElement("td");
            your_score.appendChild(document.createTextNode(y_score));

            node.appendChild(lp);
            node.appendChild(who);
            node.appendChild(scored);
            node.appendChild(tier);
            node.appendChild(your_score);
            document.querySelector("#stat_table").appendChild(node);
        }

    </script>
</body>

</html>
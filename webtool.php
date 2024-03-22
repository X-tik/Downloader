<?php

$E = "\033[1;31m";
$B = "\033[2;36m";
$G = "\033[1;32m";
$S = "\033[1;33m";
$R = "\033[0;0m";

function banner() {
    exec("figlet -f slant RakhmonovBobur", $output);
    echo $G . implode("\n", $output) . $R . PHP_EOL;
    echo $S . "Author: Rakhmonov Bobur" . $R . PHP_EOL;
}

banner();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $web = isset($_POST['web']) ? $_POST['web'] : '';
    if (!empty($web)) {
        website($web);
    } else {
        echo $E . "Please enter a valid URL." . $R;
    }
} else {
    echo '<form method="post" action="">
            Enter web link: <input type="text" name="web" required>
            <input type="submit" value="Submit">
          </form>';
}
// Rakhmonov Bobur
function website($web) {
    $ip = gethostbyname($web);
    $url_info_ip = "http://ipwhois.app/json/{$ip}";
    $response = json_decode(file_get_contents($url_info_ip), true);

    echo $G . "Website ip information:" . $R . PHP_EOL;
    echo PHP_EOL;
    echo $G . json_encode($response, JSON_PRETTY_PRINT) . $R . PHP_EOL;
    echo PHP_EOL;
    echo str_repeat("=", 40) . PHP_EOL;
    echo PHP_EOL;
    echo $B . "HTTP headers:" . $R . PHP_EOL;
    echo PHP_EOL;
    $url_head = "https://api.hackertarget.com/httpheaders/?q={$web}";
    echo $B . file_get_contents($url_head) . $R . PHP_EOL;
    echo PHP_EOL;
    echo str_repeat("=", 40) . PHP_EOL;
    echo PHP_EOL;
    echo $G . "Page Links:" . $R . PHP_EOL;
    echo PHP_EOL;
    $url_page = "https://api.hackertarget.com/pagelinks/?q={$web}";
    echo $G . file_get_contents($url_page) . $R . PHP_EOL;
    echo PHP_EOL;
    echo str_repeat("=", 40) . PHP_EOL;
    echo PHP_EOL;
    echo $S . "Find shared DNS:" . $R . PHP_EOL;
    echo PHP_EOL;
    $url_find = "https://api.hackertarget.com/findshareddns/?q={$web}";
    echo $S . file_get_contents($url_find) . $R . PHP_EOL;
    echo PHP_EOL;
    echo str_repeat("=", 40) . PHP_EOL;
}

?>

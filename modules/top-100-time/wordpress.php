<?php
    // get time from file
    $filename = "${outputFolder}top-100-time.json";
    $fp = file_get_contents($filename);
    $times = json_decode($fp)->table->results;

		function secondsToTime($seconds) {
			$dtF = new \DateTime('@0');
			$dtT = new \DateTime("@$seconds");
			return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
		}
?>
<table>
	<tr>
		<th>Rank</th>
		<th>User</th>
		<th>Total Time</th>
	</tr>
	<?php
        $rank = 1;
				$blacklist = []; // string array of names you don't want ranked publicly
        foreach ($times as $time) {
            if ($rank > 100) {
                break;
            }
						if(in_array($time, $blacklist)) {
							continue;
						}
						$convertedTime = secondsToTime($time->value);
            echo '
							<tr>
								<td>#' . $rank . '</td>
								<td>' . $time->key . '</td>
								<td>' . $convertedTime . '</td>
							</tr>
						';
            $rank++;
        }
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

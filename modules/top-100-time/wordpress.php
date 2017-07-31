<?php
    // get time from file
    $filename = "${outputFolder}top-100-time.json";
    $fp = file_get_contents($filename);
    $time = json_decode($fp);
?>
<table>
	<tr>
		<th>Rank</th>
		<th>User</th>
		<th>Total Time</th>
	</tr>
	<?php
        $rank = 1;
        foreach ($time as $user => $userTime) {
            if ($rank > 100) {
                break;
            }
            echo '
							<tr>
								<td>#' . $rank . '</td>
								<td>' . $user . '</td>
								<td>' . $userTime . '</td>
							</tr>
						';
            $rank++;
        }
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

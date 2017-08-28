<?php
    // get points from file
    $filename = "${outputFolder}top-100-points.json";
    $fp = file_get_contents($filename);
    $usersPoints = json_decode($fp)->table->results
?>
<table>
	<tr>
		<th>Rank</th>
		<th>User</th>
		<th>Points</th>
	</tr>
	<?php
        $rank = 1;
        $blacklist = []; // string array of names you don't want ranked publicly
        foreach ($usersPoints as $userPoints) {
            $user = $userPoints->key;
            $points = $userPoints->value;
            if ($rank > 100) {
                break;
            }
            if (in_array($user, $blacklist) || $points < 1) {
                continue;
            }
            echo '
							<tr>
								<td>#' . $rank . '</td>
								<td>' . $user . '</td>
								<td>' . $points . '</td>
							</tr>
						';
            $rank++;
        }
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

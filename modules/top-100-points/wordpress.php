<?php
    // get points from file
    $filename = "${outputFolder}top-100-points.json";
    $fp = file_get_contents($filename);
    $points = json_decode($fp)->table->results
?>
<table>
	<tr>
		<th>Rank</th>
		<th>User</th>
		<th>Points</th>
	</tr>
	<?php
        $rank = 1;
        foreach ($points as $userPoints) {
            if ($rank > 100) {
                break;
            }
            echo '
							<tr>
								<td>#' . $rank . '</td>
								<td>' . $userPoints->key . '</td>
								<td>' . $userPoints->value . '</td>
							</tr>
						';
            $rank++;
        }
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

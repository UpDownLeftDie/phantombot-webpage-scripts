<?php
    // get quotes from file
    $filename = "${outputFolder}points.json";
    $fp = file_get_contents($filename);
    $quotes = json_decode($fp);
?>
<table>
	<tr>
		<th>ID</th>
		<th>Quote</th>
	</tr>
	<?php
		// quote[0] = who said the quote
		// quote[1] = quote string
		// quote[2] = time in epoch in ms
		// quote[3] = game title
		foreach($quotes as $key => $quote) {
	    $quote = json_decode($quote);
			// quote time is in ms, conver to seconds
			$seconds = floor($quote[2] / 1000);
			// convert epoch to date time
			$dt = new DateTime("@$seconds", new DateTimeZone('UTC'));
			$dt->setTimeZone(new DateTimeZone('PDT'));
			$date = $dt->format('h:i A Y-m-d e');
			echo '
				<tr>
					<td><strong>#' . $key . '</strong>:</td>
					<td>
						${quote[1]} -<em>' . $quote[0] . '</em><br />
						<small>During: <u>' . $quote[3] . '</u> at {$date}</small>
					</td>
				</tr>
			';
		}
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

<?php
    // get quotes from file
    $filename = "${outputFolder}points.json";
    $fp = file_get_contents($filename);
    $quotes = json_decode($fp)->table->results;
?>
<table>
	<tr>
		<th>ID</th>
		<th>Quote</th>
	</tr>
	<?php
		// $quotes->key = quotes number
		// quote->value[0] = who said the quote
		// quote->value[1] = quote string
		// quote->value[2] = time in epoch in ms
		// quote->value[3] = game title
		foreach($quotes as $quote) {
	    $value = json_decode($quote->value);
			// quote time is in ms, conver to seconds
			$seconds = floor($value[2] / 1000);
			// convert epoch to date time
			$dt = new DateTime("@$seconds", new DateTimeZone('UTC'));
			$dt->setTimeZone(new DateTimeZone('PDT'));
			$date = $dt->format('h:i A Y-m-d e');
			echo '
				<tr>
					<td><strong>#' . $quote->key . '</strong>:</td>
					<td>' .
						$value[1] . ' -<em>' . $value[0] . '</em><br />
						<small>During: <u>' . $value[3] . '</u> at ' . $date . '</small>
					</td>
				</tr>
			';
		}
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

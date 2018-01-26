<?php
    // get quotes from file
    $filename = "${outputFolder}quotes.json";
    $fp = file_get_contents($filename);
    $botQuotes = json_decode($fp)->table->results;

    function millisecondsToDate($milliseconds)
    {
        // quote time is in ms, conver to seconds
        $seconds = floor($milliseconds / 1000);
        // convert epoch to date time
        $dt = new DateTime("@$seconds", new DateTimeZone('UTC'));
        $dt->setTimeZone(new DateTimeZone('PDT'));
        return $dt->format('h:i A Y-m-d e');
    }
?>
<table>
	<tr>
		<th>ID</th>
		<th>Quote</th>
	</tr>
	<?php
    foreach ($botQuotes as $botQuote) {
        $quoteObject = json_decode($botQuote->value);
        $number = $botQuote->key; // quote command number
        $person = $quoteObject[0]; // who said the quote
        $quote = $quoteObject[1]; // quote string
        $time = $quoteObject[2]; // time in epoch in ms
        $game = $quoteObject[3]; // game title

        $date = millisecondsToDate($time);
        echo '
					<tr>
						<td><strong>#' . $number . '</strong>:</td>
						<td>' .
                  $quote . ' -<em>' . $person . '</em><br />
									<small>During: <u>' . $game . '</u> at ' . $date . '</small>
					</td>
				</tr>
				';
    }
echo "</table>";
// when when the json was written
echo "<i>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

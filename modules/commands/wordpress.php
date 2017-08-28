<?php
    // get commands from file
    $filename = "${outputFolder}commands.json";
    $fp = file_get_contents($filename);
    $botCommands = json_decode($fp)->table->results;
?>
<table>
	<tr>
		<th>Command</th>
		<th>Output</th>
	</tr>
	<?php
    foreach ($botCommands as $botCommand) {
        $command = $botCommand->key;
        $output = $botCommand->value;
        echo '
					<tr>
						<td><strong>!' . $command . '</strong></td><td>' . $output . '</td>
					</tr>
				';
    }

echo "</table>";
// update when the json was written
echo "<i style='font-size:11px';>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

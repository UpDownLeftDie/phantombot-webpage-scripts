<?php
    // get commands from file
    $filename = "${outputFolder}commands.json";
		$fp = file_get_contents($filename);
    $commands = json_decode($fp)->table->results;
?>
<table>
	<tr>
		<th>Command</th>
		<th>Output</th>
	</tr>
	<?php
		foreach($commands as $command) {
			echo '
				<tr>
				<td><strong>!' . $command->key . '</strong></td><td>' . $command->value . '</td>
				</tr>
			';
		}

echo "</table>";
// update when the json was written
echo "<i style='font-size:11px';>Last update: " . date("F d Y H:i:s e.", filemtime($filename)) . "</i>";

<?php
    // Commands
		$name = "commands";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=command&getSortedRows&order=ASC");
    $results = curl_exec($curl);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $results);
    fclose($fp);
    unset($results);

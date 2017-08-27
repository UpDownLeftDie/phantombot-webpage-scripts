<?php
    // Top-100-Time
		$name = "top-100-time";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=time&getSortedRowsByValue&order=DESC");
    $results = curl_exec($curl);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $results);
    fclose($fp);
    unset($results);

<?php
    // Top-100-Points
		$name = "top-100-points";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=points&getKeys");
    $results = curl_exec($curl);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $results);
    fclose($fp);
    unset($results);

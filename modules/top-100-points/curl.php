<?php
    // Top-100-Points
		$name = "top-100-points";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=points&getKeys");
    $results = json_decode(curl_exec($curl));
    $points = [];

    foreach ($results->table->keylist as $keys) {
        $key = $keys->key;
        curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=points&getData=${key}");
        $object = json_decode(curl_exec($curl));

        $points["$key"] = "{$object->table->value}";
    }
    unset($results);
    arsort($points);
    $points = json_encode($points);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $points);
    fclose($fp);
    unset($points);

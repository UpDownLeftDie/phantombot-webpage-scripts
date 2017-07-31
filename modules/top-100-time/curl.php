<?php
    // Top-100-Time
		$name = "top-100-time";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=time&getKeys");
    $results = json_decode(curl_exec($curl));
    $time = [];

    foreach ($results->table->keylist as $keys) {
        $key = $keys->key;
        curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=time&getData=${key}");
        $object = json_decode(curl_exec($curl));

        $time["$key"] = "{$object->table->value}";
    }
    unset($results);
    arsort($time);
    $time = json_encode($time);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $time);
    fclose($fp);
    unset($time);

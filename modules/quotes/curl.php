<?php
    // Quotes
		$name = "quotes";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=quotes&getKeys");
    $results = json_decode(curl_exec($curl));
    $quotes = [];

    foreach ($results->table->keylist as $keys) {
        $key = $keys->key;
        curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=quotes&getData=${key}");
        $object = json_decode(curl_exec($curl));

        $quotes[$key] = $object->table->value;
    }
    unset($results);
    krsort($quotes);
    $quotes = json_encode($quotes);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $quotes);
    fclose($fp);
    unset($quotes);

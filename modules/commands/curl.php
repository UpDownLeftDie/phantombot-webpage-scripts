<?php
    // Commands
		$name = "commands";
    curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=command&getKeys");
    $results = json_decode(curl_exec($curl));
    $commands = [];

    foreach ($results->table->keylist as $keys) {
        $key = $keys->key;
        curl_setopt($curl, CURLOPT_URL, "${protocol}://${url}/dbquery?table=command&getData=${key}");
        $object = json_decode(curl_exec($curl));

        $commands["$key"] = "{$object->table->value}";
    }
    unset($results);
    arsort($commands);
    $commands = json_encode($commands);

    // write to a file
    $fp = fopen("${outputFolder}${name}.json", 'w');
    fwrite($fp, $commands);
    fclose($fp);
    unset($commands);

<?php
    $url;
    $outputFolder;
    if (substr($outputFolder, 0, -1) == basename(__DIR__)) {
        $outputFolder = '';
    }
    $protocol = 'http';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'webauth: $webauth'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    //scripts-here
    curl_close($curl);

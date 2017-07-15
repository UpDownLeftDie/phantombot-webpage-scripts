<?php
    $url;
    $outputFolder;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'webauth: $webauth'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    //scripts-here

    curl_close($curl);

<?php
        if (count($argv) < 2) {
            echo "Input at least one module\n";
        } else {
            $config = loadConfig();
            $template = getTemplateFile($config);
            $output = combineTemplates($argv, $template);
            outputCronFile($config->outputFolder, $output);
        }

function loadConfig()
{
    return json_decode(file_get_contents("config.json"));
}

function getTemplateFile($config)
{
    $coreTemplate = file_get_contents("core-template.php");
    $port = '';
    if ($config->port) {
        $port = ":{$config->port}";
    }
    $template = str_replace('$url', '$url' . " = '{$config->url}${port}'", $coreTemplate);
    $template = str_replace('$protocol = \'http\'', '$protocol' . " = '{$config->protocol}'", $template);
    $template = str_replace('$outputFolder', '$outputFolder' . " = '{$config->outputFolder}'", $template);
    $template = str_replace('$webauth', $config->webauth, $template);

    return $template;
}

function combineTemplates($argv, $template)
{
    $modules = "";
    foreach (array_slice($argv, 1) as $module) {
        if ($module === "") {
            echo "Invalid module supplied";
            break;
        } else {
            $modules .= file_get_contents("modules/{$module}/curl.php", null, null, 6) . "\n\n";
        }
    }

    return str_replace("//scripts-here", $modules, $template);
}

function outputCronFile($outputFolder, $txt)
{
    if (!file_exists($outputFolder)) {
        mkdir($outputFolder, 0777, true);
    }
    $file = fopen("{$outputFolder}/phantombot-cron.php", "w");
    fwrite($file, $txt);
    fclose($file);
    echo "Succesfully created: {$outputFolder}/phantombot-cron.php";
}

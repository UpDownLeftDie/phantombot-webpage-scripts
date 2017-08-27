## Requirements
php
Phantombot 2.3.8 or higher

## Step 1
### Create a confg file
Rename `config.example.json` to `config.json`
Change the values based on your setup

## Step 2
### Genreate a custom cron file
`php generate [module names]`
Module names are the names of the folders in `modules`
Example:
`php generate commands quotes top-100-points`

## Step 3
### Move phantombot-cron file to your server
Move or run `phantombot-cron.php` to your server
When this is ran it will output json files to the location you setup in `config.json`

## Step 4
### Wordpress integration
If youre using wordpress you can

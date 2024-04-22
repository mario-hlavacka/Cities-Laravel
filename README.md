# ui42 assignment - Laravel

## Installation steps:

## Install and run local Redis server
Redis installation instructions can be found on official Redis website - https://redis.io/docs/latest/operate/oss_and_stack/install/install-redis/

For Windows you can download Redis Server here: https://github.com/microsoftarchive/redis/releases

## Install required npm dependencies
`npm install`

## Compile and build front-end assets
`npm run dev`

## Setting the environment
Create .env file similar to .env.example

Change QUEUE_CONNECTION value to "redis" and REDIS_CLIENT value to "predis"

Create Google API key to access Google Geocode API and set GOOGLE_KEY environment variable

## Install composer dependencies
`composer install`

## Create laravel migrations
`php artisan migrate`

## Generating application key
`php artisan key:generate`

## Running the local development server
`php artisan serve`

## Application console commands
Parse and store cities data into local database:
`php artisan data:import`

Set the latitude and longitude of stored cities:
`php artisan data:geocode`

These commands are implemented using queues, so we need to run another command:
`php artisan queue:work`
in case some of the jobs fail, we can try to run the failed jobs again:
`php artisan queue:retry all`

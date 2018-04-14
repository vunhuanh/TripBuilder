# TripBuilder
TripBuilder is a web service (API) that serves as the engine for front-end websites to manage trips for their customers, written in PHP and using Slim.

## Features
* Add new trips and manage trips for each user
* Add new flights to trips and remove flights from trips based on the type of trip (one-way, round-trip, multi-city)
* Relational database utilizing real and mocked data for airports and flights
* Front-end client (written in HTML, JavaScript) to interact with the API

## Installation
* Clone repository into your server's public folder (in my case, I am using the XAMPP stack)
* Import the `TripBuilder.sql` database into your RDBMS
* Edit the connection parameters in `api/DB_connection.php` if necessary
* Launch via `client/index.php`

## Usage
* Please see the wiki for more information

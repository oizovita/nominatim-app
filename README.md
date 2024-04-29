# Nominatim API

This project is a simple API that provides endpoints for refreshing data, searching for items near a specific location,

## Table of Contents

- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
    - [Docker Installation](#docker-installation)
- [Usage](#usage)
- [Authentication](#authentication)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes.

### Prerequisites

- PHP 8 or higher
- Composer

### Installation

1. Clone the repository:
    ```
    git clone https://github.com/oizovita/nominatim-app.git
    ```
2. Navigate to the project directory:
    ```
    cd nominatim-app
    ```
3. Copy the `.env.example` file to `.env`:
    ```
    cp .env.example .env
    ```
4. Composer install for autoload classes:
    ```
    composer install
    ```
5. Start the PHP built-in server:
    ```
    ./vendor/bin/sail up -d
    ```
6. Run migrations:
    ```
    ./vendor/bin/sail artisan migrate
    ```
7. Start the queue worker:
    ```
    ./vendor/bin/sail artisan queue:work
    ```
8. Open your browser and navigate to `http://localhost:80.

Please note that the Dockerfile included in this project is set up to expose port 8000, so make sure that port is
available on your machine.

## Usage

The API provides the following endpoints:

- `PUT api/data/refresh?delaySeconds=10`: Refresh the data in the database. The `delaySeconds` query parameter is
  optional
  and specifies the number of seconds to wait before refreshing the data.
- `GET api/data/search?lat={lat}&lon={lon}`: Search for items near a specific location. The `lat` and `lon` query
  parameters
  are required and specify the latitude and longitude of the location to search around.
- `DELETE api/data`: Clear all data from the database and cache.

- `GET` `/api/jobs?limit=1`: Get a list of jobs. The `limit` query parameter is optional and specifies the maximum
  number of jobs to return.

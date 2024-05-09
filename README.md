## Requirements

- [x] PHP 8.2 or later
- [x] Laravel 11.x or later

## Installation

Pull this package in through Composer.
```
composer require adgyn/simple-analytics-laravel
```

Publish the package settings.
```
php artisan vendor:publish --tag=simple-analytics
```

Run laravel migrations.
```
php artisan migrate
```

## Usage

After installing the package, it will make 2 routes available in your project:

---

### Create a new event from a front-end request.
```
POST /analytics/event
```

Body Parameters:
Field | Description | Required | Default
--- | --- | --- | ---
event_name | Name of event | Yes | -
event_label | Label of event | Yes | -
route | Frontend route to analytics | Yes | -
reference | Reference to filter Ex: parameter of route | No | NULL

---

### Get analytics generated of events created.
```
GET /analytics/data
```

Query Parameters:
Field | Description | Required | Format | Default
--- | --- | --- | --- | ---
start_at | Start date to filter | No | Y-m-d H:i:s | -
finish_at | Finish date to filter | No | Y-m-d H:i:s | -
detailed | Returns detailed data by route, country, etc. | No | Boolean | false
routes | List of routes to filter by | No | Array<String> | []
reference | List of references to filter by | No | Array<String> | []
countries | List of countries codes to filter by. EX: BR | No | Array<String> | []
  

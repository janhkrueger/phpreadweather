# phpReadWeather

Example how to read json data showing on data from openweathermap.org for the **Quest of Islands** (https://www.questofislands.com)

Main function used is json_decode() (https://secure.php.net/manual/en/function.json-decode.php)

Used for development was **php:7.1-fpm**, running as docker container.

## What you need
* PHP, no matter of cli oder fpm
* an OpenWeathermap.org api key


## Openweathermap
In order to use the api, you need to provide an api key. If you don't have an key already, you can create one on (https://home.openweathermap.org/api_keys). You ill need a free account to obtain one.

## Locationid
Currently the presumption is that only the data for towns is read. To get the ID of a city, just search for a city on openweathermap.org. The ID you need is provided in the resulting URL.

For example, if you search for Reykjavik, IS and click on the link to get the details, you end on the following URL:

https://openweathermap.org/city/3413829

The relevant is the end part, the **3413829**. Enter this ID for $locationID in line 11.

## Error handling
In the example script only a very rudimentary error handling is implemented. How to deal with errors should fit into the concrete use case. Retry, using older, cached data or throw a hard exception is up to the requirements.

## Running
The script can be run from the webserver. Just point your browser to for example https://localhost/weather.php

### Browser, just open
```
https://localhost/weather.php
```

#### Result
```
Location name: Reykjavik
temparature: 6
Wind speed: 3.1
```

### Curl
```
curl https://localhost/weather.php
```

#### Result
```
Location name: Reykjavik<br />                                                                                                                       
temparature: 6<br />                                                                                                                                 
Wind speed: 3.1<br />                                                                                                                                
```


### PHP-CLI
```
php weather.php
```

#### Result
```
Location name: Reykjavik<br />                                                                                                                       
temparature: 6<br />                                                                                                                                 
Wind speed: 3.1<br />                                                                                                                                
```
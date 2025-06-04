<?php

return [
    /**
     * ==================
     * OpenWeatherMap API URL
     * @see https://openweathermap.org/api
     * @see https://home.openweathermap.org/users/sign_up
     */
    'url' => 'http://api.openweathermap.org/data/2.5/weather',

    /**
     * OpenWeatherMap API Key
     * @see https://home.openweathermap.org/users/sign_up
     */
    'api_key' => 'YOUR_API_KEY',

    /**
     * Units for the API response
     * @see https://openweathermap.org/current#multi
     */
    'units' => 'imperial',
    
    /**
     * Language for the API response
     * @see https://openweathermap.org/current#multi
     */
    'lang' => 'zh_cn',

    /**
     * Temperature unit for the API response
     * @see https://openweathermap.org/current#multi
     * @see https://openweathermap.org/api/units
     */
    'temp_unit' => 'C',

    /**
     * Timeout for the API request in seconds
     */
    'timeout' => 10,
    
];
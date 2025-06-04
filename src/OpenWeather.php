<?php
namespace ThankSong\OpenWeather;

use ThankSong\OpenWeather\Request\GetByCityIdRequest;
use ThankSong\OpenWeather\Request\GetByCityRequest;
use ThankSong\OpenWeather\Request\GetByCoordsRequest;
use ThankSong\OpenWeather\Request\GetByZipCodeRequest;
use ThankSong\OpenWeather\Response\OpenWeatherResponse;


/**
 * Class Weather
 * 
 * 用于静态方式获取天气数据。
 */
class OpenWeather
{
    /**
     * 通过城市名称获取天气数据。
     *
     * @param string $city
     * @return OpenWeatherResponse
     */
    public static function getByCity(string $city): OpenWeatherResponse {
         return GetByCityRequest::make($city)->get();
    }
    
    /**
     * 通过经纬度获取天气数据。
     *
     * @param float $lat
     * @param float $lon
     * @return OpenWeatherResponse
     */
    public static function getByCoords(float $lat, float $lon): OpenWeatherResponse {
        return GetByCoordsRequest::setCoords($lat, $lon)->get();
    }

    /**
     * 通过城市ID获取天气数据。
     *
     * @param int $id
     * @return OpenWeatherResponse
     */
    public static function getByCityId(int $id): OpenWeatherResponse {
        return GetByCityIdRequest::make($id)->get();
    }

    /**
     * 通过邮编获取天气数据。
     *
     * @param string $zip_code
     * @return OpenWeatherResponse
     */
    public static function getByZipCode(string $zip_code): OpenWeatherResponse {
        return GetByZipCodeRequest::make($zip_code)->get();
    }
}
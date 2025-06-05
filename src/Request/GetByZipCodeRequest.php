<?php

namespace ThankSong\OpenWeather\Request;

use ThankSong\OpenWeather\Response\OpenWeatherResponse;

use InvalidArgumentException;

/**
 * Class GetByZipCodeRequest
 * 
 * Request weather data by ZIP code.
 */
class GetByZipCodeRequest extends Client {
    protected $zip_code;

    /**
     * Set the ZIP code for the request.
     *
     * @param string $zip_code
     * @return static
     * @throws InvalidArgumentException if zip code is empty
     */
    public function setZipCode(string $zip_code): static {
        if (empty($zip_code)) {
            throw new InvalidArgumentException('Zip code cannot be empty.');
        }
        $this->zip_code = $zip_code;
        return $this;
    }

    public function get() {
        if (empty($this->zip_code)) {
            throw new InvalidArgumentException('Zip code must be set before making the request.');
        }
        $this -> setParams(['zip' => $this->zip_code]);
        return OpenWeatherResponse::format($this->doRequest());
    }

    /**
     * Get the ZIP code.
     *
     * @return string|null
     */
    public function getZipCode() {
        return $this->zip_code;
    }

    public static function make(string $zip_code): static {
        $request = new static();
        return $request->setZipCode($zip_code);
    }
}
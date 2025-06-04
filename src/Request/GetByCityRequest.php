<?php

namespace ThankSong\OpenWeather\Request;

use ThankSong\OpenWeather\Response\OpenWeatherResponse;

/**
 * 通过城市名称获取天气请求类
 *
 * 该类用于设置城市名称并发起天气查询请求。
 * 提供静态工厂方法和数据获取方法。
 */
class GetByCityRequest extends Client{
    /**
     * 城市名称
     * @var string
     */
    private $city;

    /**
     * 设置城市名称
     *
     * @param string $city 城市名称，不能为空字符串 示例：NEW YORK | NEW YORK,US
     * @return static
     * @throws \InvalidArgumentException 当传入空字符串时抛出异常
     */
    public function setCity(string $city): static{
        if (trim($city) === '') {
            throw new \InvalidArgumentException('城市名称不能为空字符串');
        }
        $this->city = $city;
        return $this;
    }

    /**
     * 获取城市名称
     *
     * @return string
     */
    public function getCity(): string{
        return $this->city;
    }

    /**
     * 静态工厂方法，快速创建请求对象并设置城市名称
     *
     * @param string $city 城市名称
     * @return static
     */
    public static function make(string $city): static{
        $request = new static();
        $request->setCity($city);
        return $request;
    }

    /**
     * 发起天气查询请求并返回格式化响应
     *
     * @return OpenWeatherResponse
     */
    public function get(): OpenWeatherResponse{
        if (trim($this->getCity()) === '') {
            throw new \InvalidArgumentException('城市名称不能为空字符串');
        }
        $this -> setParams(['q' => $this->getCity()]);
        return OpenWeatherResponse::format($this -> doRequest());
    }
}


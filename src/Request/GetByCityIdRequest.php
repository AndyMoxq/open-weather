<?php

namespace ThankSong\OpenWeather\Request;

use ThankSong\OpenWeather\Response\OpenWeatherResponse;

/**
 * 通过城市ID获取天气请求类
 *
 * 该类用于设置城市ID并发起天气查询请求。
 * 提供静态工厂方法和数据获取方法。
 */
class GetByCityIdRequest extends Client{
    /**
     * 城市 ID
     * @var int
     */
    private $cityId;

    /**
     * 设置城市 ID
     *
     * @param int $cityId 城市 ID，必须大于0
     * @return static
     * @throws \InvalidArgumentException 当传入非正整数时抛出异常
     */
    public function setCityId(int $cityId): static{
        $this -> cityId = $cityId;
        return $this;
    }

    /**
     * 获取城市名称
     *
     * @return int
     */
    public function getCityId(): int{
        return $this -> cityId;
    }

    /**
     * 静态工厂方法，快速创建请求对象并设置城市 ID
     *
     * @param int $cityId 城市 ID
     * @return static
     */
    public static function make(int $cityId): static{
        $request = new static();
        $request->setCityId($cityId);
        return $request;
    }

    /**
     * 发起天气查询请求并返回格式化响应
     *
     * @return OpenWeatherResponse
     */
    public function get(): OpenWeatherResponse{
        if ($this->getCityId() <= 0) {
            throw new \InvalidArgumentException('城市ID必须为正整数');
        }
        $this -> setParams(['id' => $this->getCityId()]);
        return OpenWeatherResponse::format($this -> doRequest());
    }
}


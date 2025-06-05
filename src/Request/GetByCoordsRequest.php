<?php
namespace ThankSong\OpenWeather\Request;
use ThankSong\OpenWeather\Response\OpenWeatherResponse;

/**
 * 通过经纬度查询天气的请求类
 */
class GetByCoordsRequest extends Client
{
    protected $lon;
    protected $lat;

    /**
     * 设置经度
     *
     * @param float $lon
     * @return static
     * @throws \InvalidArgumentException 当经度不在 -180 到 180 范围时抛出
     */
    public function setLon(float $lon): static
    {
        if ($lon < -180 || $lon > 180) {
            throw new \InvalidArgumentException('经度必须在 -180 到 180 之间');
        }
        $this->lon = $lon;
        return $this;
    }

    /**
     * 设置纬度
     *
     * @param float $lat
     * @return static
     * @throws \InvalidArgumentException 当纬度不在 -90 到 90 范围时抛出
     */
    public function setLat(float $lat): static
    {
        if ($lat < -90 || $lat > 90) {
            throw new \InvalidArgumentException('纬度必须在 -90 到 90 之间');
        }
        $this->lat = $lat;
        return $this;
    }

    /**
     * 静态工厂方法，快速创建并设置经纬度的实例
     */
    public static function setCoords(float $lon, float $lat): static
    {
        return (new static())->setLon($lon)->setLat($lat);
    }

    /**
     * 获取已设置的经度
     */
    public function getLon(): float
    {
        return $this->lon;
    }

    /**
     * 获取已设置的纬度
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * 设置参数并发送请求
     */
    public function get(): OpenWeatherResponse{
        $this -> setParams([
            'lon' => $this->getLon(),
            'lat' => $this->getLat()
        ]);
        return OpenWeatherResponse::format($this->doRequest());
    }

}
<?php
namespace ThankSong\OpenWeather\Response;

class OpenWeatherResponse {
    protected $body;

    /**
     * 构造函数，初始化响应体数据
     * @param array $body
     */
    public function __construct(array $body) {
        $this->body = $body;
    }

    /**
     * 获取完整的响应体数据
     * @return array
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * 格式化响应数据，返回 Response 实例
     * @param array $body
     * @return static
     */
    public static function format(array $body){
        return new static($body);
    }

    /**
     * 获取城市名称
     * @return string
     */
    public function getCity() {
        return $this->body['name'];
    }
    
    /**
     * 获取城市地理位置坐标
     * @return array
     */
    public function getCoord(): array {
        return $this->body['coord'];
    }

    /**
     * 获取城市的经度
     * @return float
     */
    public function getLon() {
        return $this->body['coord']['lon'];
    }

    /**
     * 获取城市的纬度
     * @return float
     */
    public function getLat() {
        return $this->body['coord']['lat'];
    }

    /**
     * 获取当前的天气状况数组
     * @return array
     */
    public function getWeather() {
        return $this->body['weather'];
    }

    /**
     * 获取当前的天气描述
     * @return string
     */
    public function getWeatherDescription() {
        return $this->body['weather'][0]['description'];
    }

    /**
     * 获取当前的天气图标标识
     * @return string
     */
    public function getWeatherIcon() {
        return $this->body['weather'][0]['icon'];
    }

    /**
     * 获取基础信息
     * @return mixed
     */
    public function getBase() {
        return $this->body['base'];
    }

    /**
     * 获取主要天气信息数组
     * @return array
     */
    public function getMain(): array {
        return $this->body['main'];
    }
    /**
     * 获取当前气温（根据配置单位转换）
     * @return string
     */
    public function getTemp(): string {
        return $this->convertTemp($this->body['main']['temp']);
    }
    /**
     * 获取体感温度（根据配置单位转换）
     * @return string
     */
    public function getFeelsLike(): string {
        return $this->convertTemp($this->body['main']['feels_like']);
    }

    /**
     * 获取最低气温（根据配置单位转换）
     * @return string
     */
    public function getMinTemp(): string {
        return $this->convertTemp($this->body['main']['temp_min']);
    }
    /**
     * 获取最高气温（根据配置单位转换）
     * @return string
     */
    public function getMaxTemp(): string {
        return $this->convertTemp($this->body['main']['temp_max']);
    }
    /**
     * 获取气压
     * @return mixed
     */
    public function getPressure() {
        return $this->body['main']['pressure'];
    }

    /**
     * 获取能见度
     * @return mixed
     */
    public function getVisibility() {
        return $this->body['visibility'];
    }

    /**
     * 获取风速及风向信息
     * @return mixed
     */
    public function getWind() {
        return $this->body['wind'];
    }

    /**
     * 获取云量信息
     * @return mixed
     */
    public function getClouds() {
        return $this->body['clouds'];
    }

    /**
     * 获取数据计算时间戳
     * @return mixed
     */
    public function getDt() {
        return $this->body['dt'];
    }

    /**
     * 获取系统数据
     * @return mixed
     */
    public function getSys() {
        return $this->body['sys'];
    }

    /**
     * 获取时区偏移秒数
     * @return mixed
     */
    public function getTimezone() {
        return $this->body['timezone'];
    }

    /**
     * 获取城市ID
     * @return mixed
     */
    public function getId() {
        return $this->body['id'];
    }

    /**
     * 获取城市名称（与 getCity 相同）
     * @return mixed
     */
    public function getName() {
        return $this->body['name'];
    }

    /**
     * 获取响应状态码
     * @return mixed|null
     */
    public function getCod() {
        return $this->body['cod'] ?? null;
    }

    /**
     * 根据配置的温度单位（C 或 F）将开尔文温度转换为摄氏或华氏温度
     * @param float $kelvin
     * @return float
     */
    protected function convertTemp(float $kelvin): string {
        return config('openweather.temp_unit', 'F') === 'C'
            ? $kelvin - 273.15 . ' °C'
            : $kelvin * 9/5 - 459.67 . ' °F';
    }

    /**
     * 验证响应是否成功（HTTP 状态码是否为 200），否则抛出异常
     * @throws \Exception
     */
    public function validate() {
      if($this -> getCod()!== 200) {
          throw new \Exception('Invalid response code');
      }
    }
}


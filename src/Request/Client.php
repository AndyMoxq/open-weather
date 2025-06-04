<?php

namespace ThankSong\OpenWeather\Request;

use Illuminate\Support\Facades\Http;

abstract class Client{
    /**
     * API KEY
     * @var string
     */
    private $api_key;
    /**
     * 请求地址
     * @var string
     */
    private $url;
    /**
     * 语言
     * @var string
     */
    private $lang;
    
    /**
     * 请求参数
     * @var array
     * @example ['q' => '北京', 'units' =>'metric']
     */
    private $params=[];
    /**
     * 请求超时时间
     * @var int
     */
    private $timeout;
    
    public function __construct(){
        $this->api_key = config('openweather.api_key', 'YOUR_API_KEY');
        $this->url = config('openweather.url', 'http://api.openweathermap.org/data/2.5/weather');
        $this->lang = config('openweather.lang', 'zh_cn');
        $this->timeout = config('openweather.timeout', 10);
    }

    /**
     * 设置API KEY
     * @param string $api_key
     * @return static
     */
    public function setApiKey(string $api_key): static{
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * 设置请求地址
     * @param string $url
     * @return static
     */
    public function setUrl(string $url): static{
        $this->url = $url;
        return $this;
    }

    /**
     * 获取API KEY
     * @return string
     */
    public function getApiKey(): string{
        return $this->api_key;
    }

    /**
     * 获取请求地址
     * @return string
     */
    public function getUrl(): string{
        return $this->url;
    }

    /**
     * 设置语言
     * @param string $lang
     * @return static
     */
    public function setLang(string $lang): static{
        $this->lang = $lang;
        return $this;
    }

    /**
     * 获取语言
     * @return string
     */
    public function getLang(): string{
        return $this->lang;
    }

    /**
     * 设置请求参数，合并已有参数
     * @param array $params
     * @return static
     */
    public function setParams(array $params): static{
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    /**
     * 获取请求参数
     * @return array
     */
    public function getParams(): array{
        return $this->params;
    }

    /**
     * 执行请求
     * @return array
     * @throws \Exception
     */
    protected function doRequest(): array{
        $response = Http::timeout($this->timeout)->get($this->url, array_merge([
            'appid' => $this->api_key,
            'lang' => $this->lang,
        ], $this->params));
        if($response->failed()){
            throw new \Exception('OpenWeather API request failed. Error message: ' . ($response -> json('message') ?? ''));
        }
        return $response->json();
    }

    /**
     * 抽象方法，子类实现具体的请求逻辑并返回结果
     * @return mixed
     */
    abstract public function get();
}
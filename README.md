


# Laravel Weather 包

这是一个用于获取天气数据的 Laravel 扩展包，支持通过城市名称、经纬度等方式调用 OpenWeather 接口。

## 安装

```bash
composer require thank-song/weather
```

## 配置发布

可选步骤，发布配置文件以便修改 API Key：

```bash
php artisan vendor:publish --tag=config
```

发布后会在 `config/openweather.php` 中看到配置项。
需要配置 `api_key` 项。
参见：[OpenWeather API](https://openweathermap.org/api)

## 使用方式

### 方式一：使用 Facade

```php
use Weather;
//通过城市名称获取天气数据
$response = Weather::getByCity('Hangzhou');

//通过经纬度获取天气数据
//$response = Weather::getByCoords(30.2711, 120.1555);

//通过城市ID获取天气数据
//$response = Weather::getByCityId(1831806);

//通过邮编获取天气数据
//$response = Weather::getByZip(310000);

// $response 为一个Response对象，可用方法如下：

echo $response->getTemp();
echo $response->getMinTemp();

var_dump($response->getWeather());
var_dump($response->getMain());
//...
```

### 方式二：使用容器解析

```php
$weather = app('weather');
$response = $weather::getByCity('Hangzhou');
```

## 可用字段

- `$response->getTemp()`：当前温度
- `$response->getMinTemp()`：最低温度
- `$response->getMaxTemp()`：最高温度
- `$response->getWeather()[0]['description']`：天气描述
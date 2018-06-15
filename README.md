# sentinel
FastD sentinel

## 说明
仅支持php-cli

## 配置FastD sentinel

- 添加配置
在config/config.php添加配置registry
```php
    'registry' => [
        //注册中心地址
        'host' => 'tcp://127.0.0.1:9998',
        //连接重试间隔，时间单位ms
        'retry_interval' => 1000,
    ]
```

- 注册
在config/process.php添加配置
 ```php
     'sentinel' => [
         \ServiceProvider\Sentinel\SentinelProcess::class
     ],
 ```
 运行php bin/process sentinel start
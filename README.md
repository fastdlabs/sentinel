# sentinel
FastD sentinel

## 说明
仅支持php-cli

## 配置FastD sentinel

- 添加配置
在config/config.php添加配置registry

```php
<?php

return [
    'registry' => [
        'host' => 'tcp://0.0.0.0:9999'
    ]
];
```

host 为发现服务器接受数据的地址，由 fastd-register 启动 swoole server 时决定，可以根据启动的ip跟端口进行调整。

- 注册
在config/process.php添加配置
 ```php
 <?php
 
 return [
     'sentinel' => [
         'process' => \ServiceProvider\Sentinel\Process\SentinelProcess::class,
         'options' => [
 
         ],
     ],
 ];
 ```

在FPM的模式下，可以通过: `php bin/process sentinel start` 命令进行启动
 
如果在swoole模式下，则需要在 `server.php` 文件中添加进程: 

```php
<?php

return [
    // some code
    'processes' => [
        \ServiceProvider\Sentinel\Process\SentinelProcess::class
    ],
    // some code
];
```
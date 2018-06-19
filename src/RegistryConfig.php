<?php
/**
 * Created by PhpStorm.
 * User: yong
 * Date: 2018/6/14
 * Time: 12:21
 */

namespace ServiceProvider\Sentinel;


class RegistryConfig
{
    public function get()
    {
        $config['extend']['database'] = config()->get('database');

        //配置不存在加载
        if (!config()->has('server')) {
            config()->merge([
                'server' => load(app()->getPath() . '/config/server.php'),
            ]);
        }
        $config['service_host'] = config()->get('server.host');
        $config['service_name'] = config()->get('name');
        $config['service_pid'] = file_get_contents(config()->get('server.options.pid_file'));

        return $config;
    }
}
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
        $config['server_name'] = config()->get('name');

        $config['database'] = config()->get('database');

        $config['server_host'] = config()->get('server.host');

        $config['server_pid'] = file_get_contents(config()->get('server.options.pid_file'));

        return $config;
    }
}
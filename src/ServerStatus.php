<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\Sentinel;


use FastD\Utils\ArrayObject;

/**
 * Class ServerStatus
 * @package ServiceProvider\Sentinel
 */
class ServerStatus extends ArrayObject
{
    public function __construct()
    {
        //配置不存在加载
        if (!config()->has('server')) {
            config()->merge([
                'server' => load(app()->getPath() . '/config/server.php'),
            ]);
        }

        $config['service_host'] = config()->get('server.host');
        $config['service_name'] = config()->get('name');
        $config['service_pid'] = !file_exists(config()->get('server.options.pid_file')) ?
            '' : file_get_contents(config()->get('server.options.pid_file'));
        $config['process_number'] = '';
        $config['server']['options'] = config()->get('server.options');
        $config['status'] = $this->flushState();

        $config['config']['database'] = config()->get('database');
        $config['config']['cache'] = config()->get('cache');

        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode($this->getArrayCopy());
    }

    /**
     * @return array
     */
    public function flushState()
    {
        return app()->has('server') ? swoole()->state() : [];
    }
}
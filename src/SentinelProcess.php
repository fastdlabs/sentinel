<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

namespace ServiceProvider\sentinel\src;


use FastD\Process\AbstractProcess;
use swoole_process;

class SentinelProcess extends AbstractProcess
{
    public function handle(swoole_process $swoole_process)
    {
        // 检测服务端是否存活，如不存活，关闭连接，等待下次检测
        timer_tick(1000, function () {

        });
    }
}
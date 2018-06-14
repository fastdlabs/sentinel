<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2017
 *
 * @see      https://www.github.com/janhuang
 * @see      http://www.fast-d.cn/
 */

namespace Process;

use FastD\Swoole\Process;
use swoole_process;

class DemoProcess extends Process
{
    public function handle(swoole_process $swoole_process)
    {
        timer_tick(1000, function ($id) {
            static $index = 0;
            ++$index;
            echo $index.PHP_EOL;
            if ($index === 10) {
                timer_clear($id);
            }
        });
    }
}
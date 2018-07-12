<?php

use FastD\Sentinel\Client;

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

/**
 * @param $service
 * @return Client
 */
function sentinel ($service)
{
    return new Client($service);
}
<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @see      https://www.github.com/fastdlabs
 * @see      http://www.fastdlabs.com/
 */

include __DIR__ . '/../../../vendor/autoload.php';

include __DIR__ . '/src/Client.php';

$client = new \FastD\Sentinel\Client('dobee');

$response = $client->call('/');

print_r($response);

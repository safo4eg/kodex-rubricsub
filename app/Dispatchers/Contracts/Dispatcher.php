<?php

namespace App\Dispatchers\Contracts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

abstract class Dispatcher
{
    protected array $versions;

    public function __construct()
    {
        $this->versions = config('api_dispatcher')[static::class];
    }

    protected function run($method, Request $request, ...$args): mixed
    {
        $apiVersion = $request->header('api-version');

        // если не указана версия в заголовке
        if(!$apiVersion) {
            throw new \Exception('API Version should be provided');
        }

        // если версии не существует
        if(!array_key_exists($apiVersion, $this->versions)) {
            throw new \Exception('API Version ' . $apiVersion . ' is not supported');
        }

        // если метод не поддерживается версией
        if(in_array($method, $this->versions[$apiVersion]['unsupported_methods'])) {
            throw new \Exception('API Version ' . $apiVersion . ' is not supported this method');
        }

        $controllerInstance = app($this->versions[$apiVersion]['controller']);
        // если метод не описан в выбранной версии, пытаемся найти предыдущую версию
        if (!is_callable([$controllerInstance, $method])) {
            $availableVersions = array_keys($this->versions);
            usort($availableVersions, function ($a, $b) {
                return version_compare($b, $a);
            });

            $previousVersion = null;
            foreach ($availableVersions as $version) {
                if(version_compare($version, $apiVersion) === -1) {
                    $apiVersion = $version;
                    break;
                }
            }

            // если предыдущей версии не найдено
            if(is_null($previousVersion)) {
                throw new \Exception('API version ' . $apiVersion . ' is not supported method');
            }

            $controllerInstance = app($this->versions[$apiVersion]['controller']);;
        }

        return App::call([$controllerInstance, $method]);
    }
}
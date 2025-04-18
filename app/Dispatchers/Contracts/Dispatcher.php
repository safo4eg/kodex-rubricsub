<?php

namespace App\Dispatchers\Contracts;

use App\Helpers\ResponseHelper;
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

    protected function getCallable(string $method): callable
    {
        $apiVersion = request()->header('api-version');

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

        $versionController = $this->versions[$apiVersion]['controller'];
        $controllerInstance = null;

        if(isset($versionController)) {
            $controllerInstance = app($versionController);
        }

        // если метод не описан в выбранной версии, пытаемся найти предыдущую версию
        // или если не указан контроллер (чтобы не плодить пустые контроллеры)
        if (!isset($versionController) || !is_callable([$controllerInstance, $method])) {
            $availableVersions = array_keys($this->versions);
            usort($availableVersions, function ($a, $b) {
                return version_compare($b, $a);
            });

            $previousVersion = null;
            foreach ($availableVersions as $version) {
                if(version_compare($version, $apiVersion) === -1) {
                    $previousVersion = $version;
                    break;
                }
            }

            // если предыдущей версии не найдено
            if(is_null($previousVersion)) {
                throw new \Exception('API version ' . $apiVersion . ' is not supported method');
            }

            $controllerInstance = app($this->versions[$previousVersion]['controller']);;
        }

        return [$controllerInstance, $method];
    }
}
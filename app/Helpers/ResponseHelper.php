<?php

namespace App\Helpers;

use Spatie\ArrayToXml\ArrayToXml;

class ResponseHelper
{
    public static function getResponse(array $data, int $status)
    {
        if(request()->wantsJson()) {
            return response()->json($data, $status);
        }

        if(request()->accepts('application/xml')) {
            $xml = ArrayToXml::convert(
                array: $data,
                rootElement: 'response',
                replaceSpacesByUnderScoresInKeyNames: true, // заменять пробелы на _
                xmlEncoding: 'utf-8', // кодировка
                addXmlDeclaration: true, // указание версии xml
                options: ['convertNullToXsiNil' => false] // конвертация null в nil
            );

            return response($xml, $status)
                ->header('Content-Type', 'application/xml');
        }

        // обработка по умолчанию
        return response(print_r($data, true), 200)
            ->header('Content-Type', 'text/plain');
    }
}
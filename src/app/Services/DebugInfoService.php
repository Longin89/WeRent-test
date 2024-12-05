<?php

namespace App\Services;

class DebugInfoService
{

    //  Служба для вычисления используемого времени и ОЗУ для проведения операций

    public static function getDebugInfo(): array
    {
        $memoryUsage = memory_get_usage() / 1024;
        $executionTime = microtime(true) - LARAVEL_START;

        return [
            'X-Debug-Time' => round($executionTime * 1000), // Вывод в мс.
            'X-Debug-Memory' => round($memoryUsage, 1), // Вывод в кб.
        ];
    }
}

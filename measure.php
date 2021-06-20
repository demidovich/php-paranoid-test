<?php

class Measure
{
    private static $title;
    private static $memoryStart;
    private static $timeStart;
    private static array $results = [];

    public static function start(string $title): void
    {
        self::stop();

        self::$title       = $title;
        self::$memoryStart = memory_get_usage();
        self::$timeStart   = hrtime(true);
    }

    private static function stop(): void
    {
        if (! self::$title) {
            return;
        }

        $memory = memory_get_usage() - self::$memoryStart;
        $time   = hrtime(true) - self::$timeStart;

        self::$results[] = [
            "title"  => self::$title,
            "memory" => self::bytesToHuman($memory),
            "time"   => self::nanosecondsToHuman($time),
        ];
    }

    public static function results(): array
    {
        self::stop();

        return self::$results;
    }

    public static function resultsAsTable(): string
    {
        $resultsHtml = "";

        foreach (self::results() as $row) {
            $resultsHtml .= "
                <tr>
                    <td>{$row['title']}</td>
                    <td>{$row['memory']}</td>
                    <td>{$row['time']}</td>
                </tr>
            ";
        }

        return "
            <html>
                <body>
                    <table border=1 cellspacing=0 cellpadding=10>
                        <thead>
                            <tr>
                                <th>Измерение</th>
                                <th>Память</th>
                                <th>Время</th>
                            </tr>
                        </thead>
                        <tbody>
                            $resultsHtml
                        </tbody>
                    </table>            
                </body>
            </html>
        ";
    }

    private static function bytesToHuman(int $bytes): string
    {
        $units = ['b', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    private static function nanosecondsToHuman(int $nanoseconds): string
    {
        return round($nanoseconds/1e+6, 1) . " milliseconds";
    }
}

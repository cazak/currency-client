<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Storage;

final class FileStorage implements Storage
{
    public function save(array $items): void
    {
        $temp = tmpfile();
        fwrite($temp, print_r($items, true));
        fclose($temp);
    }
}
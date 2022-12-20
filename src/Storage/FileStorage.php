<?php

declare(strict_types=1);

namespace Cazak\CurrencyClient\Storage;

use Cazak\CurrencyClient\Model\Model;

final class FileStorage implements Storage
{
    public function save(Model $model): void
    {
        $temp = tmpfile();
        fwrite($temp, print_r($model, true));
        fclose($temp);
    }
}

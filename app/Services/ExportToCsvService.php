<?php

namespace App\Services;

use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use League\Csv\Writer;
use SplTempFileObject;

class ExportToCsvService extends AbstractService
{

    /**
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function run(...$args)
    {
        $data = collect($args[0]);
        $headers = collect($args[1]);

        $csv = Writer::createFromString('');

        $csv->insertOne($headers->map(fn($header) => trans($header['trans_key']))->toArray());

        $csv->insertAll(
            $data->map(fn($row) => $headers->map(fn($header) => $row[$header['key']])->toArray())->toArray()
        );

        $temp = tmpfile();
        fwrite($temp, $csv->toString());
        rewind($temp);
        
        return $temp;
    }
}

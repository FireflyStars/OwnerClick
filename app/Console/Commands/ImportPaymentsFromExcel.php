<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ImportPaymentsFromExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "TEst\n";
        $inputFileName = './public/testdeneme.xls';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($inputFileName);
        $rows = $spreadsheet->getActiveSheet()->toArray();
        $keys = ['date' =>[],'comments' =>[],'payment' =>[],'currency' =>[]];
        $i = 1;
        unset($rows[0]);

        foreach ($rows as $columnKey => $row) {
            // process element here;
            if ($date = $this->isDate($row[$columnKey]) !== false) {
                if(!isset($keys['date'][$columnKey])){
                    $keys['date'][$columnKey] = 0;
                }
                $keys['date'][$columnKey] += 1;
                $date = new Carbon($row[$columnKey]);
                echo $date->format('Y-m-d');
//                $date->format('Y-m-d');
            } else {
                echo "false";
            }
            echo "--".$i."\n";
//            echo $i . "---" . $t[0] . "," . $t[1] . "," . $t[2] . " <br>\n";
            $i++;
        }
        var_dump($keys);
        return 0;

    }


    /**
     * @param $value
     * @return \DateTime
     */
    function isDate($value)
    {
        if (!$value) {
            return false;
        }

        try {
            $date = new \DateTime($value);
            return $date;
        } catch (\Exception $e) {
            return false;
        }
    }
}

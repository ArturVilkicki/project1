<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Stock;

class StockImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stocks import';

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
      $json = File::get(public_path() . '/storage/stocks.json');
      $data = json_decode($json);

      foreach ($data as $key => $obj) {
        $stock = Stock::where('sku', $obj->sku)->first();
        if ($stock) {
            $stock->sku = $obj->sku;
            $stock->stock = $obj->stock;
            $stock->city = $obj->city;
            $stock->save();
        } else {
            $stock = new Stock();
            $stock->sku = $obj->sku;
            $stock->stock = $obj->stock;
            $stock->city = $obj->city;
            $stock->save();
        }

      }


    }
}

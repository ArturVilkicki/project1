<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Tag;


class ProductsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Products import';

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
      $json = File::get(public_path() . '/storage/products.json');
      $data = json_decode($json);

      foreach ($data as $key => $obj) {
          $product = Product::where('sku', $obj->sku)->first();
        if ($product) {
            $product->sku = $obj->sku;
            $product->description = $obj->description;
            $product->size = $obj->size;
            $product->photo = $obj->photo;
            $product->save();

            $product->tag->delete();


            $tags = $obj->tags;
            if (!empty($tags)) {
                foreach ($tags as $key => $tag) {
                    $new_tag = new Tag();
                    $new_tag->product_id = $product->id;
                    $new_tag->name = $tag->title;
                    $new_tag->save();
                }


            }


        } else {
            $product = new Product();
            $product->sku = $obj->sku;
            $product->description = $obj->description;
            $product->size = $obj->size;
            $product->photo = $obj->photo;

            $product->save();

            $tags = $obj->tags;
            if (!empty($tags)) {
                foreach ($tags as $key => $tag) {
                    $new_tag = new Tag();
                    $new_tag->product_id = $product->id;
                    $new_tag->name = $tag->title;
                    $new_tag->save();
                }
            }

        }

      }
    }
}

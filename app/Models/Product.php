<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Product extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'code';

    public static function storeProduct(Request $request, $status, $imported_t){
       Product::create([
            'code' => $request->code,
            'status' => $status,
            'imported_t' => $imported_t,
            'url' => $request->url,
            'created_t' => $request->created_t, 
            'last_modified_t' => $request->last_modified_t, 
            'product_name' => $request->product_name,
            'quantity' => $request->quantity, 
            'brands' => $request->brands, 
            'categories' => $request->categories, 
            'labels' => $request->labels, 
            'cities' => $request->cities, 
            'purchase_places' => $request->purchase_places, 
            'stores' => $request->stores, 
            'ingredients_text' => $request->ingredients_text, 
            'traces' => $request->traces, 
            'serving_size' => $request->serving_size,
            'serving_quantity' => $request->serving_quantity, 
            'nutriscore_score' => $request->nutriscore_score, 
            'nutriscore_grade' => $request->nutriscore_grade,
            'main_category' => $request->main_category, 
            'image_url' => $request->image_url, 
        ]);
    }

    public static function updateProduct(Request $request, $status){
        Product::update([
             'code' => $request->code,
             'status' => $status,
             'imported_t' => $request->imported_t,
             'url' => $request->url,
             'created_t' => $request->created_t, 
             'last_modified_t' => $request->last_modified_t, 
             'product_name' => $request->product_name,
             'quantity' => $request->quantity, 
             'brands' => $request->brands, 
             'categories' => $request->categories, 
             'labels' => $request->labels, 
             'cities' => $request->cities, 
             'purchase_places' => $request->purchase_places, 
             'stores' => $request->stores, 
             'ingredients_text' => $request->ingredients_text, 
             'traces' => $request->traces, 
             'serving_size' => $request->serving_size,
             'serving_quantity' => $request->serving_quantity, 
             'nutriscore_score' => $request->nutriscore_score, 
             'nutriscore_grade' => $request->nutriscore_grade,
             'main_category' => $request->main_category, 
             'image_url' => $request->image_url, 
         ]);
     }
}

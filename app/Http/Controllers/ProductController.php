<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ApiProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     public function index(){
        try {
            $products = Product::all();

            if(Count($products) < 1){
                return response()->json('Product not found', 404);
            }

            return new ApiProduct($products);

        } catch (\Throwable $th) {
            $response = $th->getMessage();
            return response()->json($response, 500);
        }
     }

     public function show($cod){
        try {
            $product = Product::where('code', $cod)->get();

            if(Count($product) < 1){
                return response()->json('Product not found', 404);
            }

            return new ApiProduct($product);

        } catch (\Throwable $th) {
            $response = $th->getMessage();
            return response()->json($response, 500);
        }
     }

     public function store(Request $request){
        DB::beginTransaction();
        try {
            $status = 'published';
            $imported_t = Carbon::now();
            $createProduct = Product::storeProduct($request, $status, $imported_t);

            DB::commit();

            $response = [
                'message' => 'dados salvos com sucesso'
            ];

            return new ApiProduct($response);

        } catch (\Throwable $th) {
            DB::rollBack();

            $response = $th->getMessage();
            return response()->json($response, 500);
        }
     }

     public function update(Request $request, $cod){
        try {
            $status = 'draft';
            
            $product = Product::find($cod)->update([
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

            $response = [
                'message' => 'dados alterados com sucesso'
            ];

            return new ApiProduct($response);

        } catch (\Throwable $th) {
            $response = $th->getMessage();
            return response()->json($response, 500);
        }
     }

     public function destroy($cod){
        try {
            $product = Product::find($cod);
            
            if(!$product){
                return response()->json('Product not found', 404);
            }

            $product->update(['status' => 'trash']);
            
            $response = [
                'message' => 'dados atualizados com sucesso'
            ];
            return new ApiProduct($response);
        } catch (\Throwable $th) {
            $response = $th->getMessage();
            return response()->json($response, 500);
        }
     }
}

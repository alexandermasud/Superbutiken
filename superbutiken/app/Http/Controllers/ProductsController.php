<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use App\Store;
use App\ProductStore;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
        //return view('products/index')-> with('products', $products);
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->title = $request->input('title');
        $product->brand = $request->input('brand');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
        $product->save();

        //$productStore = new ProductStore;
        //$productStore->product_id = $request->input('product_id');
        //$productStore->store_id = $request->input('store_id');


        //foreach ($request->get("stores") as $store) {
            // Do something fun!
        //}
        
        return redirect()->route('products/index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $reviews = Review::where('product_id', $id)->get();
        // Finds all store/product id data that matches a given product id
        $productStores = ProductStore::where('product_id', $id)->get();

        $storesArray = array();
        $pivotArray = array();

        // Loops all results
        foreach ($productStores as $productStore){
            // storeId is assignd a store_id eg 1
            $storeId = $productStore['store_id'];
            // Gets all store data from storeId
            $stores = Store::where('id', $storeId)->get();
            // Creates pivot for stores
            $pivot = '{"product_id":'.$id.',"store_id":'.$storeId.'}';
            $pivotArray = json_decode($pivot, true);
            
            // Loops through all stores that store a certain product and pushes to array
            foreach ($stores as $store){
                // Adds pivot part to stores
                $store->{'pivot'} = $pivotArray;
                array_push($storesArray, $store);
            }
        }
        
        // Pushes reviews and stores to product
        $product->{'reviews'} = $reviews;
        $product->{'stores'} = $storesArray;

        

        //return view('products/show')-> with('product', $product);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products/edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->input('title');
        $product->brand = $request->input('brand');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
        $product->save();
        return redirect()->route('products/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('product/index');
    }
}

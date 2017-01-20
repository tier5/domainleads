<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use DB;
class ProductController extends Controller
{

     
	public function index(){
	
	//$product = Product::where('name', '=', 'jeans')->first();
   //$category = $product->getCategory;
	//return $category->name;
	//$products=Product::paginate(10);
	 $products = DB::table('products')
                ->select('*')
                ->paginate(10);
	//return $products;
	return view('products.index')->with('products',$products);
	} 
	public function ajax(){
	
	$products = DB::table('products')
                ->select('*')
                ->paginate(10);
	//$products = Product::paginate(10);
	//print_r($products);dd();
	//return $products;
	return view('products.index')->with('products',$products)->render();
	//return View::make('products.products',['products' => $products])->render();

	} 
	
	public function create(){
	 $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
	 $categories->prepend('Select', '0');
	//return $categories;
	//$categories = ['0'=>'Please select'] + Category::lists('name', 'id')->toArray();
	//return $categories;
	  return view('products.create',compact('categories'));
	} 
	
	public function edit($id){
	 $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
	 $categories->prepend('Select', '0');
	//$product=Product::find($id);
	$product=Product::where('id',$id)->first();
	//return $product;
	  return view('products.edit')->with('product',$product)->with('categories',$categories);
	} 
	
	public function update(Request $request,$id){
	 $product=Product::find($id);
	
	 $product->name=$request->name;
	 $product->price=$request->price;
	  $product->cat_id=$request->cat_id;
	 $product->save();
	  return redirect()->route('product.index');
	}
	
	public function store(Request $request){
	
	// $product=new Product;
	// $product->name=$request->name;
	// $product->price=$request->price;
	// $product->save();
	
	$inputs=$request->all();
	//dd($inputs);
	$product=Product::Create($inputs);
	return redirect()->action('ProductController@index');
	//return redirect()->route('product.index');
	 
	} 
	public function show($id){
	$product=Product::find($id);
	  return view('products.show')->with('product',$product);
	}
	public function destroy($id){
	//Product::destroy($id);
	$product=Product::find($id)->delete();
	  return redirect()->route('product.index');
	}
}

<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Product;
use App\Category;
use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Request\SearchAdvancedRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $user = auth()->user();
        $products = Product::latest()->get();

        return view('frontend.index', [
            'user_id' => $user->id,
            'products' => $products
        ]);
    }
    public function detail($id) {
        $getProDetail = Product::findOrFail($id);
        $getBrand = Product::findOrFail($id)->brands;
        // dd($brand->brand);
        $user_id = Auth::id();
        // dd(json_decode($getProDetail->product_image));
        return view('frontend.detail',compact('getProDetail','user_id','getBrand'));
    }
    public function search_ajax(Request $request) {
        $data = $request->all();
        $output='';
        $products = Product::where('product_name','LIKE','%'.$data['keywords'].'%')->get();
        if ($products) {
            $output .= '<ul style="
            top: 100%;left: 0;z-index: 1000;min-width: 10rem;padding: 0.5rem 0;
            margin: 0.125rem 0 0;font-size: 1.5rem;color: #212529;text-align: left;list-style: none;background-color: #fff;border: 1px groove;border-radius: 0.25rem;">';
            foreach($products as $product){
                $output .= '<li class="li_search"><a href="#">'.$product->product_name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function search(Request $request) {
        $data = $request->all();
        $user_id = Auth::id();
        $product = Product::where('product_name','LIKE','%'.$data['search'].'%')->get();
        return view('frontend.search',compact('product','data','user_id'));

    }
    public function search_advanced () {
        $brand = Brand::all();
        $category = Category::all();
        return view('frontend.search-advanced',compact('brand','category'));
    }
    public function search_adv(Request $request) {
        $data = $request->all();
        $user_id = Auth::id();
        if ($data['price'] == 0)  {
            $product = Product::where('product_name','LIKE','%'.$data['name'].'%')->whereBetween('product_price',[0,500])->where('product_category',$data['cate'])->where('product_brand',$data['brand'])->where('product_status',$data['status'])->get();
        }
        if ($data['price'] == 1)  {
            $product = Product::where('product_name','LIKE','%'.$data['name'].'%')->whereBetween('product_price',[500,1000])->where('product_category',$data['cate'])->where('product_brand',$data['brand'])->where('product_status',$data['status'])->get();
        }
        if ($data['price'] == 2)  {
            $product = Product::where('product_name','LIKE','%'.$data['name'].'%')->whereBetween('product_price',[1000,1500])->where('product_category',$data['cate'])->where('product_brand',$data['brand'])->where('product_status',$data['status'])->get();
        }
        if ($data['price'] == 3)  {
            $product = Product::where('product_name','LIKE','%'.$data['name'].'%')->where('product_price','>',1500)->where('product_category',$data['cate'])->where('product_brand',$data['brand'])->where('product_status',$data['status'])->get();
        }
        $product = Product::all();
        return view('frontend.search',compact('product','data','user_id'));
    }
}

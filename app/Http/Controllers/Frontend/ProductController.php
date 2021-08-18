<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Category;
use App\Brand;
use Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getProduct = Product::all();
        $user_id = Auth::id();
        return view('frontend.product',compact('getProduct',$getProduct),compact('user_id',$user_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        return view('frontend.add_product')->with('category',$category)->with('brand',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if ($request->hasFile('filename')) {
            foreach($request->file('filename') as $image) {
                $name = date("Y.m.d").".".$image ->getClientOriginalName();
                $name2 = "small_".date("Y.m.d").".".$image ->getClientOriginalName();
                $name3 = "large_".date("Y.m.d").".".$image ->getClientOriginalName();
                if (!is_dir("./upload/product/$user_id")) {
                    mkdir("./upload/product/$user_id");

                }
                $path = public_path('upload/product/'.$user_id.'/'. $name);
                $path2 = public_path('upload/product/'.$user_id.'/'. $name2);
                $path3 = public_path('upload/product/'.$user_id.'/'. $name3);
                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(85, 85)->save($path2);
                Image::make($image->getRealPath())->resize(266, 381)->save($path3);
                $data[] = $name;
            }
        }
        $new_product= new Product();
        $new_product->product_name = $request->name;
        $new_product->product_price = $request->price;
        $new_product->product_category = $request->selCate;
        $new_product->product_brand = $request->selBra;
        $new_product->product_status = $request->selSale;
        $new_product->product_sale_price = $request->saleprice;
        $new_product->product_detail = $request->detail;
        $new_product->product_image=json_encode($data);
        $new_product->save();
        return redirect()->route('product.index')->with('success','Them san pham thanh cong');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $getProduct = Product::findOrFail($id);
        $category =Product::findOrFail($id)->categories;
        $brand =Product::findOrFail($id)->brands;
        $allCategory = Category::all();
        $allBrand = Brand::all();
        return view('frontend.edit_product',compact('getProduct','brand','category','allCategory','allBrand','user_id'));     
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
        // dd($data);
        $user_id = Auth::id();
        $product = Product::findOrFail($id);
        $imgDel = $request->input('imageCheckDel');
        $imgOld = json_decode($product->product_image);
        $imgNew = [];
        // // dd(print_r(array_diff($imgOld,$imgDel)));
        // if ($imgDel) {
        //  foreach ($imgDel as $img) {
        //     if(file_exists("./upload/product/$user_id/$img")) {
        //         unlink("./upload/product/$user_id/$img");
        //     }
        // }

        if ($product) {
            // xoa
            if ($imgDel) {
                foreach($imgDel as $value) {
                    if(in_array($value, $imgOld)) {
                        $imgOld = array_values(array_diff($imgOld,$imgDel));
                        foreach($imgOld as $value){
                            array_push($imgNew, $value);
                        }
                    }
                }
            }
            // k xoa k them
            else {
                $imgNew = $imgOld;
            };   
            // them
            if ($request->hasFile('filename')) {
                foreach($request->file('filename') as $image) {
                    $name = date("Y.m.d").".".$image ->getClientOriginalName();
                    $name2 = "small_".date("Y.m.d").".".$image ->getClientOriginalName();
                    $name3 = "large_".date("Y.m.d").".".$image ->getClientOriginalName();
                    if (!is_dir("./upload/product/$user_id")) {
                        mkdir("./upload/product/$user_id");
                    }
                    $path = public_path('upload/product/'.$user_id.'/'. $name);
                    $path2 = public_path('upload/product/'.$user_id.'/'. $name2);
                    $path3 = public_path('upload/product/'.$user_id.'/'. $name3);
                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(85,84)->save($path2);
                    Image::make($image->getRealPath())->resize(266,381)->save($path3);
                    array_push($imgNew,$name);
                }
            }
            // check dk > 3
            if (count($imgNew) > 3) {
                return redirect()->back()->with('success','Hinh anh khong duoc lon hon 3');
            } 
            $product->product_name = $request->input('name');
            $product->product_price = $request->input('price');
            $product->product_category = $request->input('selCate');
            $product->product_brand = $request->input('selBra');
            $product->product_status = $request->input('selSale');
            $product->product_sale_price = $request->input('saleprice');
            $product->product_image = json_encode($imgNew);
            $product->product_detail = $request->input('detail');
            $product->save();
        }
        return redirect()->back()->with('success','Update thanh cong');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getProduct = Product::findOrFail($id);
        if ($getProduct) {
            $getProduct->delete();
        }
        return redirect()->back()->with('delete','Xoa thanh cong');
    }
}

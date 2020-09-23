<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProduct()
    {
        $data['productlist'] = DB::table('vp_products')
        ->join('vp_categories', 'vp_products.prod_cate', '=', 'vp_categories.cate_id')
        ->orderBy('prod_id', 'desc')->get();
        return view('backend.product', $data);
    }

    public function getAddProduct()
    {
        $data['catelist'] = Category::all();
        return view('backend.addproduct', $data);
    }

    public function postAddProduct(AddProductRequest $request)
    {
        $filename = $request->img->getClientOriginalName();
        $product = new Product;
        $product->prod_name = $request->name;
        $product->prod_slug = str_slug($request->name);
        $product->prod_img= $filename;
        $product->prod_price = $request->price;
        $product->prod_accessories = $request->accessories;
        $product->prod_warranty = $request->warranty;
        $product->prod_promotion = $request->promotion;
        $product->prod_condition = $request->condition;
        $product->prod_description = $request->description;
        $product->prod_status = $request->status;
        $product->prod_cate = $request->cate;
        $product->prod_featured = $request->featured;
        $product->save();
        $request->img->storeAs('avatar', $filename);

        return redirect('admin/product/add');
    }

    public function getEditProduct($id)
    {
        $data['product'] = Product::findOrFail($id);
        $data['categories'] = Category::all();
        return view('backend.editProduct', $data);
    }

    public function putEditProduct(UpdateProductRequest $request, $id)
    {
        if($request->hasFile('img')) {
            $filename = $request->img->getClientOriginalName();
            $request->img->storeAS('avatar', $filename);
        } else {
            $filename = Product::findOrFail($id)->prod_img;
        }
        $product = Product::findOrFail($id)->update([
            'prod_name' => $request->name,
            'prod_slug' => str_slug($request->name),
            'prod_img' => $filename,
            'prod_price' => $request->price,
            'prod_accessories' => $request->accessories,
            'prod_warranty' => $request->warranty,
            'prod_promotion' => $request->promotion,
            'prod_condition' => $request->condition,
            'prod_description' => $request->description,
            'prod_status' => $request->status,
            'prod_cate' => $request->cate,
            'prod_featured' => $request->featured,
        ]);

        return redirect('admin/product');
    }

    public function getDeleteCProduct($id)
    {
        Product::findOrFail($id)->delete();
        return redirect('admin/product');
    }
}

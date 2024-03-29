<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\APIBaseController;
use Illuminate\Http\Request;

use App\Model\API\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends APIBaseController
{
    public function index()
    {
        $Products = Product::all();
        return json_encode($Products);
        // return $this->sendSuccess($Products->toArray(), "ProductsList Successfully!");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_barcode' => 'required',
            'product_qty' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'product_category' => 'required',
            'product_status' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $product_data = array(
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_barcode' => $request->product_barcode,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image,
                'product_category' => $request->product_category,
                'product_status' => $request->product_status,
                'created_at' => NOW()
            );

            $products = Product::create($product_data);
            return $this->sendSuccess($products->toArray(), "Product create successfully.");
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_barcode' => 'required',
            'product_qty' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'product_category' => 'required',
            'product_status' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $product_data = array(
                'product_name' => $request->product_name,
                'product_detail' => $request->product_detail,
                'product_barcode' => $request->product_barcode,
                'product_qty' => $request->product_qty,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image,
                'product_category' => $request->product_category,
                'product_status' => $request->product_status,
                'updated_at' => NOW()
            );

            $products = Product::where('id', $id)->update($product_data);
            return $this->sendSuccess($products, "Product update successfully.");
        }
    }


    public function destroy($id)
    {
        $products = Product::where('id', $id)->delete();
        return $this->sendSuccess($products, "Product delete successfully.");
    }
}

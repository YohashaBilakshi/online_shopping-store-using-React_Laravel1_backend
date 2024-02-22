<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Category;
use App\Models\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ShoppingMallController extends BaseController
{
    public function createCategory(Request $request){

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Error', $validator->errors());
            }

            Category::insert([
                'name' =>  $request->input('name'),
                'description' =>  $request->input('description'),
            ]);

            return $this->sendResponse(null, 'Category added succesfully.', 200);

        } catch (\Throwable $th) {

            return $this->sendError('An error occur while adding category', ['error' => $th]);
            // return $th;
        }
        
    }

    public function getCategories() {

        try {
           
            $category = Category::all();

            $data = [
                'category' => $category
            ];
            return $this->sendResponse($data , 'Data succesfully fetched', 200);

        } catch (\Throwable $th) {

            return $this->sendError('An error occur while adding category', ['error' => $th]);
            // return $th;
        }
    }

    public function storeProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error', $validator->errors());
        }

        try {
           
            Product::insert([
                'code' => $request->input('code'), 
                'name' => $request->input('name'), 
                'price' => $request->input('price'), 
                'quantity' => $request->input('quantity'), 
                'category' => $request->input('category'), 
                'discount' => $request->input('discount'), 
                'active' => $request->input('active'), 
                'dummy_price' => $request->input('dummy_price'), 
                'description' => $request->input('description'), 
                'small_description' => $request->input('small_description'), 
                'inqueryImg' => $request->input('inqueryImg'), 
                'keyword' => $request->input('keyword'), 
            ]);


            return $this->sendResponse( null , 'Product added succesfully', 200);


        } catch (\Throwable $th) {

            // return $this->sendError('An error occur while adding category', ['error' => $th]);
            return $th;
        }
    }

}

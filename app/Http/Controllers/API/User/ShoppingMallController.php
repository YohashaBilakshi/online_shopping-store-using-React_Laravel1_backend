<?php

namespace App\Http\Controllers\API\User;

use App\Models\Category;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoppingMallController extends BaseController
{

    public function getCategories() {

        try {
           
            $category = Category::where('status', 1)->get();

            $data = [
                'category' => $category
            ];
            return $this->sendResponse($data , 'Data succesfully fetched', 200);

        } catch (\Throwable $th) {

            return $this->sendError('An error occur while adding category', ['error' => $th]);
            // return $th;
        }
    }

}

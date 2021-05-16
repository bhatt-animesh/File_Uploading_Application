<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Product;
use App\ProductImages;
use Auth;

class ProductController extends Controller
{
    public function index() {

        $getproduct = Product::where('user_id', Auth::id())->get();
        return view('user.product', compact('getproduct'));
    }

    public function list()
    {
        $getproduct = Product::where('user_id', Auth::id())->get();
        return view('user_tables.producttable',compact('getproduct'));
    }

    public function productimages($id) {
        $getproductimages = ProductImages::where('product_id', $id)->get();
        $productdetails = Product::where('product.id', $id)->get()->first();
        return view('user.product-images', compact('getproductimages','productdetails'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'user_id' => 'required',
          'item_name' => 'required',
          'description' => 'required',
          'file' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            $item = new Product;
        
            $item->user_id =htmlspecialchars($request->user_id, ENT_QUOTES, 'UTF-8');
            $item->product_name =htmlspecialchars($request->item_name, ENT_QUOTES, 'UTF-8');
            $item->product_description =htmlspecialchars($request->description, ENT_QUOTES, 'UTF-8');
            $item->save();

            if ($request->hasFile('file')) {
                $files = $request->file('file');
                foreach($files as $file){
                    $itemimage = new productImages;
                    $image = 'product-' . uniqid() . '.' . $file->getClientOriginalExtension();                
                    
                    $file->move('data/product', $image);
                    
                    $itemimage->product_id =$item->id;
                    $itemimage->image =$image;
                    $itemimage->save();
                }
            }
            

            $success_output = 'Product Added Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function storeimages(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'file' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {

            if ($request->hasFile('file')) {
                $files = $request->file('file');
                foreach($files as $file){

                    $itemimage = new ProductImages;
                    $image = 'product-' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->move('data/product', $image);

                    $itemimage->product_id =$request->itemid;
                    $itemimage->image =$image;
                    echo $itemimage->save();
                }
            }

            $success_output = 'Product Added Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function show(Request $request)
    {
        $item = Product::findorFail($request->id);
        $getproduct = Product::where('id',$request->id)->first();
        return response()->json(['ResponseCode' => 1, 'ResponseText' => 'Product fetch successfully', 'ResponseData' => $getproduct], 200);
    }

    public function showimage(Request $request)
    {
        $getproduct = ProductImages::where('id',$request->id)->first();
        if($getproduct->image){
            $getproduct->img=url('data/product/'.$getproduct->image);
        }
        return response()->json(['ResponseCode' => 1, 'ResponseText' => 'Product Image fetch successfully', 'ResponseData' => $getproduct], 200);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'item_name' => 'required',
          'getdescription' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
            // dd($error_array);
        }
        else
        {
            $item = new Product;
            $item->exists = true;
            $item->id = $request->id;

            $item->product_name =htmlspecialchars($request->item_name, ENT_QUOTES, 'UTF-8');
            $item->product_description =htmlspecialchars($request->getdescription, ENT_QUOTES, 'UTF-8');
            $item->save();           

            $success_output = 'Product updated Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function updateimage(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'image' => 'require|mimes:jpeg,png,jpg,pdf'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
            // dd($error_array);
        }
        else
        {
            $itemimage = new ProductImages;
            $itemimage->exists = true;
            $itemimage->id = $request->id;

            if(isset($request->image)){
                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $image = 'product-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move('data/product', $image);
                    $itemimage->image=$image;
                    unlink(public_path('data/product/'.$request->old_img));
                }            
            }
            $itemimage->save();           

            $success_output = 'Product updated Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function destroyimage(Request $request)
    {
        $getimg = ProductImages::where('id',$request->id)->first();
        unlink(public_path('data/product/'.$getimg->image));

        $itemimage=ProductImages::where('id', $request->id)->delete();
        if ($itemimage) {
            return 1;
        } else {
            return 0;
        }
    }

    public function status(Request $request)
    {
        $UpdateDetails = Product::where('id', $request->id)->delete();
        $UpdateDetailss = ProductImages::where('product_id', $request->id)->delete();
        if ($UpdateDetails) {
            return 2;
        } else {
            return 0;
        }
    }

}

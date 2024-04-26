<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('ajax');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($product) {
            $product->update([
                'name' => $request->name,
                'detail' => $request->detail
            ]);
            $message = 'Record updated successfully.';
        } else {
            $product = new Product;
            $product->name = $request->name;
            $product->detail = $request->detail;
            $product->save();
            $message = 'Record created successfully.';
        }

        return response()->json(['success' => $message]);
    }

    /**
     * Check if a product name already exists.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
    public function checkNameExists(Request $request)
    {
        $exists = Product::where('name',$request->name)->get()->first();
        // dd($exists);

        if($exists == null){
            $data=['status'=>false];
            return response()->json($data);
        }else{
            $data=['status'=>true];
            return response()->json($data);
        }
    } 
    */
   /**
 * Check if a product name already exists.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */

public function checkNameExists(Request $request)
{
    $exists = Product::where('name', $request->name)->exists();

    return response()->json(['exists' => $exists]);
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
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
      
        return response()->json(['success'=>'Record deleted successfully.']);
    }
}

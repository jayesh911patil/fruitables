<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BestsellerproductsModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class BestsellerproductsController extends Controller
{
    public function Bestsellerproducts(Request $request)
    {
        if ($request->ajax()) {
            $data = BestsellerproductsModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-best-seller-products', ['bestsellerproducts_id' => $row->bestsellerproducts_id]);
                    $deleteUrl = route('delete-best-seller-products', ['bestsellerproducts_id' => $row->bestsellerproducts_id]);

                    $csrfToken = csrf_token();

                    $actionBtn = '
                    <a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">  
                        ' . method_field('DELETE') . '
                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                        <a href="' . $deleteUrl . '" class="delete btn btn-danger btn-sm">Delete</a>
                    </form>';
                    return $actionBtn;
                })
                ->addColumn('image', function ($row) {
                    return '<img style="width:120px; height:120px;" src="' . asset($row->image) . '" class="img-fluid" alt="img">';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('Admin/best-seller-products/best-seller-products');
    }

    public function Addbestsellerproducts()
    {
        return view('Admin/best-seller-products/add');
    }

    public function Addstorebestsellerproducts(Request $request)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'price' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/best-seller-products/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['image' => $path . $image, 'title' => $request->title, 'price' => $request->price,];
        BestsellerproductsModel::create($data);//load model//
        return redirect()->route('best-seller-products')->with('success', 'best-seller-products added successfully!');
    }

    public function Editbestsellerproducts($bestsellerproducts_id)
    {
        $data = BestsellerproductsModel::find($bestsellerproducts_id);
        return view('Admin/best-seller-products/edit', compact('data'));
    }

    public function Editstorebestsellerproducts(Request $request, $bestsellerproducts_id)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'price' => 'required'
            ]
        );
        $data = BestsellerproductsModel::find($bestsellerproducts_id);

        $data->title = $request->title;
        $data->price = $request->price;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/best-seller-products/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/best-seller-products/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('best-seller-products')->with('success', 'best-seller-products added successfully!');
    }
    public function Deletebestsellerproducts($bestsellerproducts_id)
    {
        $data = BestsellerproductsModel::findOrFail($bestsellerproducts_id);
        $data->delete();
        return redirect()->route('best-seller-products')->with('best-seller-products entry deleted successfully');
    }
}
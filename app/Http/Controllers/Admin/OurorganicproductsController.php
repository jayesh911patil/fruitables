<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurorganicproductsModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class OurorganicproductsController extends Controller
{
    public function Ourorganicproducts(Request $request)
    {
        if ($request->ajax()) {
            $data = OurorganicproductsModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-our-organic-products', ['ourorganicproducts_id' => $row->ourorganicproducts_id]);
                    $deleteUrl = route('delete-our-organic-products', ['ourorganicproducts_id' => $row->ourorganicproducts_id]);
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
        return view('Admin/our-organic-products/our-organic-products');
    }

    public function Addourorganicproducts()
    {
        return view('Admin/our-organic-products/add');
    }

    public function Addstoreourorganicproducts(Request $request)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'tag' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/our-organic-products/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['image' => $path . $image, 'title' => $request->title, 'description' => $request->description, 'price' => $request->price, 'tag' => $request->tag];
        OurorganicproductsModel::create($data);//load model//
        return redirect()->route('our-organic-products')->with('success', 'our-organic-products added successfully!');
    }

    public function Editourorganicproducts($ourorganicproducts_id)
    {
        $data = OurorganicproductsModel::find($ourorganicproducts_id);
        return view('Admin/our-organic-products/edit', compact('data'));
    }

    public function Editstoreourorganicproducts(Request $request, $ourorganicproducts_id)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'tag' => 'required'
            ]
        );
        $data = OurorganicproductsModel::find($ourorganicproducts_id);


        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->tag = $request->tag;


        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/our-organic-products/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/our-organic-products/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('our-organic-products')->with('success', 'our-organic-products added successfully!');
    }
    public function Deleteoourorganinproduncts($ourorganicproducts_id)
    {
        $data = OurorganicproductsModel::findOrFail($ourorganicproducts_id);
        $data->delete();
        return redirect()->route('our-organic-products')->with('our-organic-products entry deleted successfully!');
    }
}

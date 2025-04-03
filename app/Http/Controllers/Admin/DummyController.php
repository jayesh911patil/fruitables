<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DummyModel;
use Illuminate\Support\Facades\File;


use DataTables;


class DummyController extends Controller
{
    public function Dummy(Request $request){

        if ($request->ajax()) {
            $data = DummyModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-dummy', ['dummyid' => $row->dummyid]);
                    $deleteUrl = route('delete-store-dummy', ['dummyid' => $row->dummyid]);
                   
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
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('Admin/dummy/dummy');
    }

    public function Adddummy(){
        return view('Admin/dummy/add');
    }

    public function Addstoredummy(Request $request){
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/dummy/';

if ($request->hasFile('image')) {
    $file = $request->file('image');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    
    // Move file to the destination
    $file->move(public_path($path), $filename);

    // Store full image path
    $imagePath = $path . $filename;
} else {
    $imagePath = null; // Handle case where no file is uploaded
}

        $data = ['image' => $imagePath, 'title' => $request->title];
        DummyModel::create($data);//load model//

        return redirect()->route('dummy')->with('success', 'organic-veggies added successfully!');
        
    }


    public function Editdummy($dummyid){

        $data = DummyModel::find($dummyid);
        return view('Admin/dummy/edit', compact('data'));
    }

    public function Editstoredummy(Request $request, $dummyid){
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required'
            ]
        );

        $data = DummyModel::find($dummyid);

        $data->title = $request->title;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/dummy/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/dummy/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();
        return redirect()->route('dummy');

    }


    public function Deletedummy($dummyid)
    {
        $data = DummyModel::findOrFail($dummyid);
        $data->delete();
        return redirect()->route('dummy');
    }
}
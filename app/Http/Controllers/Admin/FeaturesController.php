<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturesModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class FeaturesController extends Controller
{
    public function Features(Request $request)
    {
        if ($request->ajax()) {
            $data = FeaturesModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-features', ['features_id' => $row->features_id]);
                    $deleteUrl = route('delete-features', ['features_id' => $row->features_id]);
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
        return view('Admin/features/features');
    }

    public function Addfeatures()
    {
        return view('Admin/features/add');
    }

    public function Addstorefeatures(Request $request)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/features/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['image' => $path . $image, 'title' => $request->title, 'description' => $request->description];
        FeaturesModel::create($data);//load model//
        return redirect()->route('features')->with('success', 'features added successfully!');
    }

    public function Editfeatures($features_id)
    {
        $data = FeaturesModel::find($features_id);
        return view('Admin/features/edit', compact('data'));
    }

    public function Editstorefeatures(Request $request, $features_id)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]
        );
        $data = FeaturesModel::find($features_id);


        $data->title = $request->title;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/features/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/features/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('features')->with('success', 'features added successfully!');
    }

    public function Deletefeatures($features_id)
    {
        $data = FeaturesModel::findOrFail($features_id);
        $data->delete();
        return redirect()->route('features')->with('success', 'features entry deleted successfully!');
    }
}

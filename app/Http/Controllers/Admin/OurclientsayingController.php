<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurclientsayingModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class OurclientsayingController extends Controller
{
    public function Ourclientsaying(Request $request)
    {
        if ($request->ajax()) {
            $data = OurclientsayingModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-our-client-saying', ['ourclientsaying_id' => $row->ourclientsaying_id]);
                    $deleteUrl = route('delete-our-client-saying', ['ourclientsaying_id' => $row->ourclientsaying_id]);
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
        return view('Admin/our-client-saying/our-client-saying');
    }

    public function Addourclientsaying()
    {
        return view('Admin/our-client-saying/add');
    }

    public function Addstoreourclientsaying(Request $request)
    {
        $validated = $request->validate(
            [
                'description' => 'required',
                'image' => 'required',
                'title' => 'required',
                'position' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/our-client-saying/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['description' => $request->description, 'image' => $path . $image, 'title' => $request->title, 'position' => $request->position];
        OurclientsayingModel::create($data);//load model//
        return redirect()->route('our-client-saying')->with('success', 'our-client-saying added successfully!');
    }

    public function Editourclientsaying($ourclientsaying_id)
    {
        $data = OurclientsayingModel::find($ourclientsaying_id);
        return view('Admin/our-client-saying/edit', compact('data'));
    }

    public function Editstoreourclientsaying(Request $request, $ourclientsaying_id)
    {
        $validated = $request->validate(
            [
                'description' => 'required',
                'image' => 'required',
                'title' => 'required',
                'position' => 'required'
            ]
        );
        $data = OurclientsayingModel::find($ourclientsaying_id);


        $data->description = $request->description;
        $data->title = $request->title;
        $data->position = $request->position;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/our-client-saying/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/our-client-saying/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('our-client-saying')->with('success', 'our-client-saying added successfully!');
    }

    public function Deleteourclientsaying($ourclientsaying_id)
    {
        $data = OurclientsayingModel::findOrFail($ourclientsaying_id);
        $data->delete();
        return redirect()->route('our-client-saying')->with('our-client-saying entery deleted successfully');
    }
}

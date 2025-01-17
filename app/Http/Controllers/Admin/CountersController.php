<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountersModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class CountersController extends Controller
{
    public function Counters(Request $request)
    {
        if ($request->ajax()) {
            $data = CountersModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-counters', ['counters_id' => $row->counters_id]);
                    $deleteUrl = route('delete-counters', ['counters_id' => $row->counters_id]);
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
        return view('Admin/counters/counters');
    }

    public function Addcounters()
    {
        return view('Admin/counters/add');
    }

    public function Addstorecounters(Request $request)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'count' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/counters/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['image' => $path . $image, 'title' => $request->title, 'count' => $request->count];
        CountersModel::create($data);//load model//
        return redirect()->route('counters')->with('success', 'counters added successfully!');
    }

    public function Editcounters($counters_id)
    {
        $data = CountersModel::find($counters_id);
        return view('Admin/counters/edit', compact('data'));
    }

    public function Editstorecounters(Request $request, $counters_id)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'count' => 'required'
            ]
        );
        $data = CountersModel::find($counters_id);


        $data->title = $request->title;
        $data->count = $request->count;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/counters/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/counters/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('counters')->with('success', 'counters added successfully!');
    }
    public function Deletecounters($counters_id)
    {
        $data = CountersModel::findOrFail($counters_id);
        $data->delete();
        return redirect()->route('counters')->with('counters entery deleted successfully');
    }
}

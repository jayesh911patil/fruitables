<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreshorganicvegetablesModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class FreshorganicvegetablesController extends Controller
{
    public function Freshorganicvegetables(Request $request)
    {
        if ($request->ajax()) {
            $data = FreshorganicvegetablesModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-fresh-organic-vegetables', ['freshorganicvegetables_id' => $row->freshorganicvegetables_id]);
                    $deleteUrl = route('delete-fresh-organic-vegetables', ['freshorganicvegetables_id' => $row->freshorganicvegetables_id]);

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
        return view('Admin/fresh-organic-vegetables/fresh-organic-vegetables');
    }

    public function Addfreshorganicvegetables()
    {
        return view('Admin/fresh-organic-vegetables/add');
    }

    public function Addstorefreshorganicvegetables(Request $request)
    {
        $validated = $request->validate(
            [
                'tag' => 'required',
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
                'price' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/fresh-organic-vegetables/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['tag' => $request->tag, 'image' => $path . $image, 'title' => $request->title, 'description' => $request->description, 'price' => $request->price,];
        FreshorganicvegetablesModel::create($data);//load model//
        return redirect()->route('fresh-organic-vegetables')->with('success', 'fresh-organic-vegetables added successfully!');
    }

    public function Editfreshorganicvegetables($freshorganicvegetables_id)
    {
        $data = FreshorganicvegetablesModel::find($freshorganicvegetables_id);
        return view('Admin/fresh-organic-vegetables/edit', compact('data'));
    }

    public function Editstorefreshorganicvegetables(Request $request, $freshorganicvegetables_id)
    {
        $validated = $request->validate(
            [
                'tag' => 'required',
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
                'price' => 'required'
            ]
        );
        $data = FreshorganicvegetablesModel::find($freshorganicvegetables_id);


        $data->tag = $request->tag;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/fresh-organic-vegetables/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/fresh-organic-vegetables/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('fresh-organic-vegetables')->with('success', 'fresh-organic-vegetables added successfully!');
    }

    public function Deletefreshorganicvegetables($freshorganicvegetables_id)
    {
        $data = FreshorganicvegetablesModel::findOrFail($freshorganicvegetables_id);
        $data->delete();
        return redirect()->route('fresh-organic-vegetables')->with('fresh-organic-vegetables entry deleted successfully');
    }
}

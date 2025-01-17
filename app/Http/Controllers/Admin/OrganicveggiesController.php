<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganicveggiesModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;


class OrganicveggiesController extends Controller
{
    public function Organicveggies(Request $request)
    {
        if ($request->ajax()) {
            $data = OrganicveggiesModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-organic-veggies', ['Organicveggies_id' => $row->Organicveggies_id]);
                    $deleteUrl = route('delete-admin-organic-veggies', ['Organicveggies_id' => $row->Organicveggies_id]);
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
        return view('Admin/organic-veggies/organic-veggies');
    }

    public function Addorganicveggies()
    {
        return view('Admin/organic-veggies/add');
    }

    public function Addstoreorganicveggies(Request $request)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/organic-veggies/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['image' => $path . $image, 'title' => $request->title];
        OrganicveggiesModel::create($data);//load model//
        return redirect()->route('organic-veggies')->with('success', 'organic-veggies added successfully!');
    }

    public function Editorganicveggies($Organicveggies_id)
    {
        $data = OrganicveggiesModel::find($Organicveggies_id);
        return view('Admin/organic-veggies/edit', compact('data'));
    }

    public function Editstoreorganicveggies(Request $request, $Organicveggies_id)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required'
            ]
        );
        $data = OrganicveggiesModel::find($Organicveggies_id);


        $data->title = $request->title;

        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/organic-veggies/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/organic-veggies/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('organic-veggies')->with('success', 'organic-veggies added successfully!');
    }

    public function Deleteorganicveggies($Organicveggies_id)
    {
        $data = OrganicveggiesModel::findOrFail($Organicveggies_id);
        $data->delete();
        return redirect()->route('organic-veggies')->with('success', 'organic-veggies entry deleted successfully!');
    }
}

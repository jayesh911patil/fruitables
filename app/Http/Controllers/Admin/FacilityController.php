<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacilityModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DataTables;

class FacilityController extends Controller
{
    public function Facility(Request $request)
    {
        if ($request->ajax()) {
            $data = FacilityModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-facility', ['facility_id' => $row->facility_id]);
                    $deleteUrl = route('delete-facility', ['facility_id' => $row->facility_id]);
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
        return view('Admin/facility/facility');
    }

    public function Addfacility()
    {
        return view('Admin/facility/add');
    }

    public function Addstorefacility(Request $request)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]
        );
        $path = 'admin-assets/assets/img/facility/';
        $file = $request->file('image');
        $image = uploadImage($file, $path);
        $data = ['image' => $path . $image, 'title' => $request->title, 'description' => $request->description];
        FacilityModel::create($data);//load model//
        return redirect()->route('facility')->with('success', 'facility added successfully!');
    }

    public function Editfacility($facility_id)
    {
        $data = FacilityModel::find($facility_id);
        return view('Admin/facility/edit' , compact('data'));
    }

    public function Editstorefacility(Request $request, $facility_id)
    {
        $validated = $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]
        );
        $data = FacilityModel::find($facility_id);


        $data->title = $request->title;
        $data->description = $request->description;


        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/facility/';
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('admin-assets/assets/img/facility/', $filename);
            $data->image = $path . $filename;
        }

        $data->save();

        return redirect()->route('facility')->with('success', 'facility added successfully!');
    }
    public function Deletefacility($facility_id)
    {
        $data = FacilityModel::findOrFail($facility_id);
        $data->delete();
        return redirect()->route('facility')->with('facility entry deleted successfully!');
    }
}

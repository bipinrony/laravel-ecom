<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = "Slider";
        $data['sliders'] = Slider::all();
        return view('admin.slider.index', $data);
    }

    public function create()
    {
        $data = array();
        $data['title'] = "Add Slider";
        return view('admin.slider.create', $data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'image' => 'required',
        ]);

        // $slider = new Slider();
        // $slider->head_text = $request->head_text;
        // $slider->para_text = $request->para_text;
        $image = $request->file('image');
        $path = $image->store('public/images/sliders');
        // $slider->image = $path;
        // $slider->status = $request->status;

        $status = DB::table('sliders')->insert(
            [
                'head_text' => $request->head_text,
                'para_text' => $request->para_text,
                'image' => $path,
                'status' => $request->status,
            ]
        );

        // if($slider->save()){
        if ($status) {
            return redirect()->route('admin.sliders')->with('success', 'Slider added successfully');
        } else {
            return redirect()->route('admin.sliders')->with('error', 'Something went wrong');
        }
    }

    public function edit(Slider $slider)
    {
        $data = array();
        $data['title'] = "Edit Slider";
        $data['slider'] = $slider;
        return view('admin.slider.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image'
        ]);

        $slider = Slider::find($request->id);
        $slider->head_text = $request->head_text;
        $slider->para_text = $request->para_text;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images/slider');
            $slider->image = $path;
        }
        $slider->status = $request->status;
        if ($slider->save()) {
            return redirect()->route('admin.sliders')->with('success', 'Slider updated successfully');
        } else {
            return redirect()->route('admin.sliders')->with('error', 'Something went wrong');
        }
    }

    public function delete(Slider $slider)
    {
        if (!empty($slider) && $slider->delete()) {
            return redirect()->route('admin.sliders')->with('success', 'Slider deleted successfully.');
        } else {
            return redirect()->route('admin.sliders')->with('error', 'Something went wrong.');
        }
    }
}

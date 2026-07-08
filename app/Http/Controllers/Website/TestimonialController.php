<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use PHPUnit\Util\Test;

class TestimonialController extends Controller




{
    public function testimonial_list(){
        $testimonials = Testimonial::all();
        return view('Admin.testimonial.testimonial_list',compact('testimonials'));
    }

   public function testimonial_add(){
    return view('Admin.testimonial.testimonial_add');
   }


   public function testimonial_save(Request $request){
      $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' =>['required','string'],
            'message' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:,jpg,jpeg,png,webp']
        ]);
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->position = $request->position;
        $testimonial->message = $request->message;
        $image = $request->image;
        $image_name = time() . "_" . $image->getClientOriginalName();
        $request->image->move('images/testimonial/', $image_name);
        $testimonial->image = $image_name;
        $testimonial->save();
        return redirect()->route('testimonial_list')->with('success', 'Testimonila inserted Successfully!s');
   }


   public function testimonial_edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('Admin.testimonial.testimonial_edit', compact('testimonial'));
    }

   public function testimonial_update(Request $request, $id)
{
    
    $testimonial = Testimonial::findOrFail($id);

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'position' => ['required', 'string'],
        'message' => ['required', 'string'],
    ]);
   

    if ($request->hasFile('image')) {
        $request->validate([
            'image' => ['image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        // delete old image
        if ($testimonial->image && file_exists(public_path('images/testimonial/' . $testimonial->image))) {
            unlink(public_path('images/testimonial/' . $testimonial->image));
        }

        // upload new image
        $image = $request->file('image');
        $image_name = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path('images/testimonial'), $image_name);

        $testimonial->image = $image_name;
    }

    $testimonial->name = $request->name;
    $testimonial->position = $request->position;
    $testimonial->message = $request->message;
    $testimonial->save();
    return redirect()->route('testimonial_list')
        ->with('success', 'Testimonial Updated Successfully!');
}

    public function testimonial_delete($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect()->route('testimonial_list')->with('success', 'Testimonial Deleted Successfully!');
    }
     


    public function testimonial(){
        $testimonials = Testimonial::all();
        return view('webside.testimonial.testimonial',compact('testimonials'));
    }
}

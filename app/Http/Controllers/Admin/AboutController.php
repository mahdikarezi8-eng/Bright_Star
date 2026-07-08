<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Classe;
use App\Models\Contact;
use App\Models\Teacher;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about_list()
    {
        $abouts = About::all();
        return view('Admin.about.about_list', compact('abouts'));
    }

    public function about_add()
    {
        return view('Admin.about.about_add');
    }
    public function about_save(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:,jpg,jpeg,png,webp']
        ]);


        // return $request->all();
        $about = new About();
        $about->title = $request->title;
        $about->description = $request->description;
        $image = $request->image;
        $image_name = time() . "_" . $image->getClientOriginalName();
        $request->image->move('images/about/', $image_name);
        $about->image = $image_name;
        $about->save();
        return redirect()->route('about_list')->with('success', 'About inserted Successfully!s');
    }

    public function about_edit($id)
    {
        $about = About::find($id);
        return view('Admin.about.about_edit', compact('about'));
    }

    public function about_update(Request $request, $id)
    {
        $about = About::find($id);
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
        if (!is_null($request->image)) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:,jpg,jpeg,png,webp'],
            ]);
        }
        // return $request->all();
        $about->title = $request->title;
        $about->description = $request->description;
        $image = $request->image;
        if ($image) {

            if ($about->image && file_exists(public_path('images/about/' . $about->image))) {
                unlink(public_path('images/about/' . $about->image));
            }
            $image_name = time() . "_" . $image->getClientOriginalName();
            $request->image->move('images/about/', $image_name);
            $about->image = $image_name;
        }
        $about->save();
        return redirect()->route('about_list')->with('success', 'About Updated Successfully!');
    }


    public function about_delete($id)
    {
        $about = About::find($id);
        $about->delete();
        return redirect()->route('about_list')->with('success', 'About Deleted Successfully!');
    }

    public function home_page()
    {
        $testimonials = Testimonial::all();
        $teachers = Teacher::all();
        $about = About::first();
        $classes = Classe::all();
        return view('welcome', compact('about','teachers','testimonials','classes'));
    }
    //about managment
    public function about()
    {
        $teachers = Teacher::all();
        $about = About::first();
        return view('webside.about.about', compact('about','teachers'));

    }



    public function footer(){
        $contact = Contact::all();
        return view('webside.layout.footer',compact('contact'));
    }


}

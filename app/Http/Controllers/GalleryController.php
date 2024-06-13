<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $gallerys = Gallery::get();
        return view('gallery.index', compact('gallerys'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $uploadPath = "uploads/gallery/";

            $file = $request->file('file');

            $extention = $file->getClientOriginalExtension();
            $filename = time() . '-' . rand(0, 99) . '.' . $extention;
            $file->move($uploadPath, $filename);

            $finalImageName = $uploadPath . $filename;

            Gallery::create([
                'image' => $finalImageName
            ]);

            return response()->json(['success' => 'Image Uploaded Successfully']);
        } else {
            return response()->json(['error' => 'File upload failed.']);
        }
    }

    public function destroy (int $id)
    {
        $gallery = Gallery::FindorFail($id);
        if(File::exists($gallery->image)){
            File::delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->back()->with('status', 'Image deleted successfully');
    }
}

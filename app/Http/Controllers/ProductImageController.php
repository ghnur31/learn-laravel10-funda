<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function index(int $productId)
    {
        $product = Products::findOrFail($productId);
        $productImages = ProductImage::where('product_id', $productId)->get();
        return view('product-image.index', compact('product', 'productImages'));
    }


    public function store(Request $request, int $productId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        $product = Products::findOrFail($productId);

        $imageData = [];
        if ($files = $request->file('images')) {

            foreach ($files as $key => $file) {

                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '.' . $extension;

                $path = "uploads/products/";

                $file->move($path, $filename);

                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path . $filename,
                ];
            }
        }

        ProductImage::insert($imageData);

        return redirect()->back()->with('status', 'Uploaded Successfully');

    }

    public function destroy(int $productImageId)
    {
        $productImage = ProductImage::findOrFail($productImageId);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();

        return redirect()->back()->with('status', 'Image Deleted');
    }
}

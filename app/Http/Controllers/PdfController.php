<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $products = Products::with('images')->get();

        $data = [
            'title' => 'ghustech',
            'date' => date('d/m/Y'),
            'products' => $products,
        ];

        $pdf = Pdf::loadView('products/generate-product-pdf', $data);
        return $pdf->download('ghustech-product-data.pdf');        
    }
}

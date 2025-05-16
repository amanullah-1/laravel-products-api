<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductImportService;
use Illuminate\Http\Request;

class ProductImportController extends Controller
{
    public function __construct(
        protected ProductImportService $importService
    ) {
 
    }

    public function import()
    {
        $result = $this->importService->importProducts();
        
        return response()->json($result, $result['success'] ? 200 : 400);
    }
}
<?php

namespace App\Http\Controllers\Product;

use App\Constants\Product\ProductConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreImageRequest;
use App\Repositories\ProductRepository;
use App\Traits\ImageTrait;

class ProductImageController extends Controller
{
    use ImageTrait;

    private $productRepository;

    function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function update($id, ProductStoreImageRequest $request){
        $imageName = $this->storeImage($request->image, ProductConstants::PRODUCT_IMAGES_DIR);
        $product = $this->productRepository->update($id, ['image' => $imageName]);
        return response()->json(['data' => $product]);
    }

}

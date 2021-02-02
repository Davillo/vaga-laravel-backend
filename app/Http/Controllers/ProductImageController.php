<?php

namespace App\Http\Controllers;

use App\Constants\Product\ProductConstants;
use App\Http\Requests\Product\ProductStoreImageRequest;
use App\Models\Product;
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

    public function store($id, ProductStoreImageRequest $request){
        $imageName = $this->storeImage($request->image, ProductConstants::PRODUCT_IMAGES_DIR);
        $category = $this->productRepository->update($id, ['image' => $imageName]);
        return $category;
    }

}

<?php

namespace App\Http\Controllers\Customer;

use App\Constants\Customer\CustomerConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerStoreImageRequest;
use App\Repositories\CustomerRepository;
use App\Traits\ImageTrait;

class CustomerImageController extends Controller
{
    use ImageTrait;

    private $customerRepository;

    function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    function store(CustomerStoreImageRequest $request, int $id){
        $imageName = $this->storeImage($request->image, CustomerConstants::CUSTOMER_IMAGES_DIR);
        $customer = $this->customerRepository->update($id, ['image' => $imageName]);
        return $customer;
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Constants\User\UserConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserImageUpdateRequest;
use App\Repositories\UserRepository;
use App\Traits\ImageTrait;

class UserImageController extends Controller
{
    use ImageTrait;

    private $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function update(UserImageUpdateRequest $request){
        $imageName = $this->storeImage($request->image, UserConstants::USER_IMAGES_DIR);
        $user = $this->userRepository->update(auth('api')->user()->id, ['image' => $imageName]);
        return response()->json(['data' => $user]);
    }
}

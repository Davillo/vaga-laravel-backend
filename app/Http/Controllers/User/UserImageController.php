<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserImageUpdateRequest;
use App\Repositories\UserRepository;
use App\Traits\ImageTrait;
use UserConstants;

class UserImageController extends Controller
{
    use ImageTrait;

    private $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->$userRepository = $userRepository;
    }

    function update(UserImageUpdateRequest $request){
        $imageName = $this->storeImage($request->image, UserConstants::USER_IMAGES_DIR);
        $user = $this->userRepository->update($request->user('api')->id, ['image' => $imageName]);
        return $user;
    }
}

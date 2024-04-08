<?php
/***
 * Author: chen ray
 * Email: chenraygogo@gmail.com
 * 2024/3/29 {TIME}
 **/

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use App\Models\Image;

class UsersController extends Controller
{

    public function update(UserRequest $request)
    {
        $user = $request->user();

        $attributes = $request->only(['name', 'email', 'introduction']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return (new UserResource($user))->showSensitiveFields();
    }

    /**
     * @throws AuthenticationException
     */
    public function store(UserRequest $request): UserResource
    {
        $cacheKey = 'captcha_'.$request->captcha_key;
        $verifyData = Cache::get($cacheKey);

        if (!$verifyData) {
            abort(403, 'captcha code expired');
        }

        if (!hash_equals($verifyData, $request->captcha_code)) {
            // 返回401
            throw new AuthenticationException('captcha code error');
        }

        $user = User::create([
            'name' => $request->name,
            'password' => $request->password,
        ]);

        // 清除验证码缓存
        Cache::forget($cacheKey);

        return (new UserResource($user))->showSensitiveFields();
    }

    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    public function activeIndex(User $user): AnonymousResourceCollection
    {
        UserResource::wrap('data');
        return UserResource::collection($user->getActiveUsers());
    }

}

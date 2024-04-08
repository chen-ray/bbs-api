<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class CaptchaController extends Controller
{
    public function store(CaptchaBuilder $captchaBuilder): JsonResponse
    {
        $key = Str::random(15);
        $cacheKey =  'captcha_'.$key;
        $captcha = $captchaBuilder->build();

        $expiredAt = config('app.env') == 'local' ? now()->addMinutes(10) : now()->addMinutes(2);

        Cache::put($cacheKey, $captcha->getPhrase(), $expiredAt);
        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return response()->json($result)->setStatusCode(201);
    }
}

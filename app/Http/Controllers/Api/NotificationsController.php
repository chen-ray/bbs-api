<?php
/***
 * Author: CHEN Ray
 * Email: chenraygogo@gmail.com
 * Create_at: 2024/4/2 0:07
 **/

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationsController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $notifications = $request->user()->notifications()->paginate();

        return NotificationResource::collection($notifications);
    }

    public function stats(Request $request): JsonResponse
    {
        return response()->json([
            'unread_count' => $request->user()->notification_count,
        ]);
    }

    public function read(Request $request)
    {
        $request->user()->markAsRead();
        return response(null, 204);
    }
}

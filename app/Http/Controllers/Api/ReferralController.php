<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function __construct(
        protected ReferralService $referralService,
    ) {}

    public function link(Request $request): JsonResponse
    {
        $user = $request->user();
        $link = $this->referralService->buildReferralLink($user->referral_code);

        return response()->json([
            'referral_code' => $user->referral_code,
            'link'          => $link,
        ]);
    }

    public function tree(Request $request): JsonResponse
    {
        $user = $request->user();
        $tree = $this->referralService->getReferralTree($user);

        $safeFields = ['id', 'name', 'email', 'referral_code', 'status', 'created_at'];

        return response()->json([
            'user'      => $tree['user']->only($safeFields),
            'ancestors' => $tree['ancestors']->map->only($safeFields)->values(),
            'children'  => $tree['children']->map->only($safeFields)->values(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReferralService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'link' => $link,
        ]);
    }

    public function tree(Request $request): JsonResponse
    {
        $user = $request->user();
        $tree = $this->referralService->getReferralTree($user);

        return response()->json([
            'user' => $tree['user'],
            'ancestors' => $tree['ancestors'],
            'children' => $tree['children'],
        ]);
    }
}

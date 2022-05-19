<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function index(): object
    {
        return ShortLink::query()->orderBy('created_at', 'desc')->paginate(10);
    }

    public function store(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'link' => 'required|url'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'data' => $validate->errors()->first()
            ], 422);
        }

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);
        $find = ShortLink::query()->where('code', '=', $input['code'])->first();

        if (!empty($find)) {
            return response()->json([
                'data' => 'Failed to create url for duplicate data entry, please try again'
            ], 412);
        }

        ShortLink::create($input);

        return response()->json([
            'data' => 'Shorten Link Generated Successfully!'
        ], 201);
    }

    public function shortenLink($code): JsonResponse
    {
        $find = ShortLink::query()->where('code', '=', $code)->first();

        if (empty($find)) {
            return response()->json([
                'data' => 'Not found any data, please try again'
            ], 404);
        }

        return response()->json([
            'data' => $find
        ], 200);
    }

    public function redirect($code): object
    {
        $find = ShortLink::query()->where('code', '=', $code)->first();

        if (empty($find)) {
            return redirect('/');
        }

        return redirect($find->link);
    }
}

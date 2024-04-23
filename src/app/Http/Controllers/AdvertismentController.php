<?php

namespace App\Http\Controllers;

use App\Models\Advertisment;
use http\Encoding\Stream;
use http\Env\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdvertismentController extends Controller
{
    public function getAll(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'sort_date' => 'nullable|in:asc,desc',
                'sort_price' => 'nullable|in:asc,desc',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $sortDate = $request->query('sort_date');
            $sortPrice = $request->query('sort_price');
            $advertisments = Advertisment::query();
            if ($sortDate) {
                $advertisments = $advertisments->orderBy('created_at', strtoupper($sortDate));
            }
            if ($sortPrice) {
                $advertisments = $advertisments->orderBy('price', strtoupper($sortPrice));
            }
            $advertisments = $advertisments->select(['id','name', 'main_cover', 'price'])->paginate(10);
            return response()->json($advertisments, 200);
        } catch (\Throwable $throwable) {
            return response()->json([], 500);
        }

    }

    public function getOne(Request $request, string $id)
    {
        try {
            $hasFilelds = $request->query('fields', false);

            $advertisment = Advertisment::find($id);
            if (!$advertisment) {
                return response()->json(['message' => 'not found'], 404);
            }
            if (!$hasFilelds) {
                $advertisment = $advertisment->only(['name', 'main_cover', 'price']);
                return response()->json($advertisment, 200);
            }
            $advertisment['links'] = json_decode($advertisment['links']);
            return response()->json($advertisment, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'server error'], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:1|max:200',
                'description' => 'required|string|min:1|max:1000',
                'main_cover' => 'required|url',
                'price' => 'required|numeric|min:1',
                'links' => 'array|max:3',
                'links.*' => 'url',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $body = $request->all();
            $body['links'] = json_encode($body['links']);
            $newAdvertisment = Advertisment::create($body);
            $newAdvertisment->save();
            return response()->json(['status'=>'succes','id'=>$newAdvertisment->id],201);
        }catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>$th->getMessage()], 500);
        }
    }
}

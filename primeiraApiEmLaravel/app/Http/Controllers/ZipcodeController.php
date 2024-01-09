<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreUpdateZipcode;
use App\Http\Resources\ZipcodeResource;

use App\Models\Zipcode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ZipcodeController extends Controller
{
    ###OK
    public function index()
    {
        $zipcode = Zipcode::paginate();

        return ZipcodeResource::collection($zipcode);
    }

    ###OK
    public function show(string $id)
    {
        $zipcode = Zipcode::findOrFail($id);

        return new ZipcodeResource($zipcode);
    }

    ###OK
    public function store(StoreUpdateZipcode $request)
    {
        $data = $request->validated();
        $zipcode = Zipcode::create($data);
        return new ZipcodeResource($zipcode);
    }


    ###OK
    public function update(StoreUpdateZipcode $request, string $id)
    {

        $zipcode = Zipcode::findOrFail($id);

        $data = $request->all();

        $zipcode->update($data);

        return new ZipcodeResource($zipcode);
    }

    ###OK
    public function destroy(string $id)
    {
        $zipcode = Zipcode::findOrFail($id)->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

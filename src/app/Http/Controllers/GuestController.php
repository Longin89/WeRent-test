<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\Guest\UpdateRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Services\DebugInfoService;

class GuestController extends Controller
{
    protected $debugInfo;

    //  Конструктор для x-debug-time и x-debug-memory

    public function __construct(DebugInfoService $debugInfoService)
    {
        $this->debugInfo = $debugInfoService->getDebugInfo();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::all();

    //  Здесь и далее - подобным образом возращаем результат вместе с необходимыми заголовками

        return response()->json(GuestResource::collection($guests))->withHeaders($this->debugInfo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

    //  Если поле country отсутствует, устанавливаем его на основе номера телефона с помощью getCountryFromPhone

        if (!isset($data['country'])) {
            $data['country'] = Guest::getCountryFromPhone($data['phone']);
        }

        $guest = Guest::create($data);

        return response()->json(GuestResource::make($guest))->withHeaders($this->debugInfo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return response()->json(GuestResource::make($guest))->withHeaders($this->debugInfo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Guest $guest)
    {
        $data = $request->validated();
        $guest->update($data);
        return response()->json(GuestResource::make($guest))->withHeaders($this->debugInfo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response([
            'message' => 'Запись успешно удалена',
        ], 200)->withHeaders($this->debugInfo);
    }
}

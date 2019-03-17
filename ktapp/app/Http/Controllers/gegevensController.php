<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gegevens;

class gegevensController extends Controller
{
    public function get(Request $request)
    {
        $data = $request->validate([
            'UserId' => 'required|integer',
            'GegevensDatum' => 'date|nullable',
            'GegevensWeek' => 'integer|nullable',
        ]);
        if(isset($data['GegevensWeek'])) {
            return Gegevens::where([
                ['UserId', $data['UserId']],
                ['GegevensWeek', $data['GegevensWeek']],
                ['archived', 0],
                ])->get();
        } elseif(isset($data['GegevensDatum'])) {
            return Gegevens::where([
                ['UserId', $data['UserId']],
                ['GegevensDatum', $data['GegevensDatum']],
                ['archived', 0],
                ])->get();
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'UserId' => 'required|integer',
            'GegevensDatum' => 'required|date',
            'GegevensWeek' => 'required|integer',
            'GegevensDag' => 'required|string',
            'GegevensJaar' => 'required|integer',
            'GegevensKm' => 'string|nullable',
            'GegevensLocatie' => 'string|nullable',
            'GegevensAankomst' => 'string|nullable',
            'GegevensVertrek' => 'string|nullable',
            'GegevensNo' => 'string|nullable',
        ]);

        $item = Gegevens::forceCreate($data);
        return $item;
    }

    public function update(Request $request) {
        $data = $request->validate([
            'GegevensId' => 'required|integer',
            'UserId' => 'required|integer',
            'GegevensDatum' => 'required|date',
            'GegevensWeek' => 'required|integer',
            'GegevensDag' => 'required|string',
            'GegevensJaar' => 'required|integer',
            'GegevensKm' => 'string|nullable',
            'GegevensLocatie' => 'string|nullable',
            'GegevensAankomst' => 'string|nullable',
            'GegevensVertrek' => 'string|nullable',
            'GegevensNo' => 'string|nullable',
        ]);
        $item = Gegevens::where([
            ['UserId', $data['UserId']],
            ['GegevensId', $data['GegevensId']],
            ['GegevensDatum', $data['GegevensDatum']],
            ['GegevensWeek', $data['GegevensWeek']],
            ['GegevensDag', $data['GegevensDag']],
            ['GegevensJaar', $data['GegevensJaar']],
            ['archived', 0],
        ]);
        $item->update($data);
        return Gegevens::where([
            ['UserId', $data['UserId']],
            ['GegevensId', $data['GegevensId']],
            ['GegevensDatum', $data['GegevensDatum']],
            ['GegevensWeek', $data['GegevensWeek']],
            ['GegevensDag', $data['GegevensDag']],
            ['GegevensJaar', $data['GegevensJaar']],
            ['archived', 0],
        ])->get();
    }

    public function archive(Request $request) {
        $data = $request->validate([
            'UserId' => 'required|integer',
            'GegevensId' => 'required|integer',
            'GegevensDatum' => 'date|required',
            'GegevensWeek' => 'integer|required',
            'GegevensDag' => 'string|required',
            'GegevensJaar' => 'integer|required',
        ]);

        $item = Gegevens::where([
            ['UserId', $data['UserId']],
            ['GegevensId', $data['GegevensId']],
            ['GegevensDatum', $data['GegevensDatum']],
            ['GegevensWeek', $data['GegevensWeek']],
            ['GegevensDag', $data['GegevensDag']],
            ['GegevensJaar', $data['GegevensJaar']],
            ['archived', 0],
        ]);
        $item->update(['archived' => 1]);
        return $item->get();
    }
}

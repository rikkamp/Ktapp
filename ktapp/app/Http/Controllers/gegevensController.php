<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gegevens;
use App\User;
use App\DaysOfWeek;
use PDF;
use Mail;

class GegevensController extends Controller
{
    public function get(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'gegevens_datum' => 'date|nullable',
            'gegevens_week' => 'integer|nullable',
        ]);

        if(isset($data['gegevens_week'])) {
            $result = [];
            $items = Gegevens::where([
                ['user_id', $data['user_id']],
                ['gegevens_week', $data['gegevens_week']],
                ['archived', 0],
            ])->get();

            foreach($items as $item) {
                array_push($result, $item);
                $item['gegevens_dag'] = $item->days['dag'];
            }

            $result['result'] = true;
            return $result;
        } elseif(isset($data['gegevens_datum'])) {
            $result = [];

            $items = Gegevens::where([
                ['user_id', $data['user_id']],
                ['gegevens_datum', $data['gegevens_datum']],
                ['archived', 0],
            ])->get();

            foreach($items as $item) {
                array_push($result, $item);
                $item['gegevens_dag'] = $item->days['dag'];
            }

            $result['result'] = true;
            return $result;
        }
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'gegevens_datum' => 'required|date',
            'gegevens_week' => 'required|integer',
            'days_id' => 'required|string',
            'gegevens_jaar' => 'required|integer',
            'gegevens_km' => 'string|nullable',
            'gegevens_locatie' => 'string|nullable',
            'gegevens_aankomst' => 'string|nullable',
            'gegevens_vertrek' => 'string|nullable',
            'gegevens_no' => 'string|nullable',
        ]);

        $item = Gegevens::forceCreate($data);
        return $result = ['result' => true, 'item' => $item];
    }

    public function update(Request $request) {
        $data = $request->validate([
            'gegevens_id' => 'required|integer',
            'user_id' => 'required|integer',
            'gegevens_datum' => 'required|date',
            'gegevens_week' => 'required|integer',
            'days_id' => 'required|integer',
            'gegevens_jaar' => 'required|integer',
            'gegevens_km' => 'string|nullable',
            'gegevens_locatie' => 'string|nullable',
            'gegevens_aankomst' => 'string|nullable',
            'gegevens_vertrek' => 'string|nullable',
            'gegevens_no' => 'string|nullable',
        ]);

        $item = Gegevens::where([
            ['user_id', $data['user_id']],
            ['gegevens_id', $data['gegevens_id']],
            ['gegevens_datum', $data['gegevens_datum']],
            ['gegevens_week', $data['gegevens_week']],
            ['days_id', $data['days_id']],
            ['gegevens_jaar', $data['gegevens_jaar']],
            ['archived', 0],
        ]);

        $item->update($data);

        return $result = ['result' => true, 'item' => Gegevens::where([
            ['user_id', $data['user_id']],
            ['gegevens_id', $data['gegevens_id']],
            ['gegevens_datum', $data['gegevens_datum']],
            ['gegevens_week', $data['gegevens_week']],
            ['days_id', $data['days_id']],
            ['gegevens_jaar', $data['gegevens_jaar']],
            ['archived', 0],
        ])->get()];
    }

    public function archive(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'gegevens_id' => 'required|integer',
            'gegevens_datum' => 'date|required',
            'gegevens_week' => 'integer|required',
            'days_id' => 'string|required',
            'gegevens_jaar' => 'integer|required',
        ]);

        $item = Gegevens::where([
            ['user_id', $data['user_id']],
            ['gegevens_id', $data['gegevens_id']],
            ['gegevens_datum', $data['gegevens_datum']],
            ['gegevens_week', $data['gegevens_week']],
            ['days_id', $data['days_id']],
            ['gegevens_jaar', $data['gegevens_jaar']],
        ]);
        
        $item->update(['archived' => 1]);
        return $result = ['result' => true, 'item' => $item->get()];
    }
    
    public function pdf(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'gegevens_week' => 'integer|required',
        ]);

        $dagen = [];
            
        $gegevens = Gegevens::where([
            ['user_id', $data['user_id']],
            ['gegevens_week', $data['gegevens_week']],
            ['archived', 0],
        ])->get();

        foreach($gegevens as $item) {
            if (!in_array($item->days['dag'], $dagen)) {
                array_push($dagen, $item->days['dag']);
            }
        }

        $default = Gegevens::select('gegevens_datum', 'gegevens_week')->distinct()->get();
        $week = $data['gegevens_week'];

        view()->share('default', $default);
        view()->share('week', $week);
        view()->share('gegevens', $gegevens);

        $user = User::find($data['user_id'])->get()->first();
        $pdf = PDF::loadView('pdf')->save('files/'. $data['user_id'] .'Week'. $data['gegevens_week'].'.pdf');
        $path = 'files/'. $data['user_id'] .'Week'. $data['gegevens_week'].'.pdf';
        $info = ['gegevens' => $user];
            Mail::send('mail', $info, function ($message) use ($path, $week, $user) {
                $message->from('KT-APP@noreply.com', 'root');
                $message->to($user['email'], $user['name']);
                $message->attach(public_path() . '/' . $path);
                $message->subject("De gegevens van week ".$week);
            });

            unlink($path);

        return $result = ['result' => true];
    }
}

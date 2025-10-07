<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NutritionController extends Controller
{
    public function index()
    {
        // awalnya belum ada hasil
        return view('nutrition.index', ['result' => null]);
    }

    public function analyze(Request $request)
    {
        $food = $request->input('food');

        $appId = config('services.edamam.app_id');
        $appKey = config('services.edamam.app_key');

        // panggil API Edamam
        $response = Http::get('https://api.edamam.com/api/nutrition-data', [
            'app_id' => $appId,
            'app_key' => $appKey,
            'ingr' => $food,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['msg' => 'Gagal mengambil data dari API.']);
        }

        $data = $response->json();
        $nutrients = $data['ingredients'][0]['parsed'][0]['nutrients'] ?? [];

        $result = [
            'food' => $food,
            'calories' => $nutrients['ENERC_KCAL']['quantity'] ?? 0,
            'protein' => $nutrients['PROCNT']['quantity'] ?? 0,
            'fat' => $nutrients['FAT']['quantity'] ?? 0,
            'carbs' => $nutrients['CHOCDF']['quantity'] ?? 0,
            'fiber' => $nutrients['FIBTG']['quantity'] ?? 0,
            'calcium' => $nutrients['CA']['quantity'] ?? 0,
            'vitaminC' => $nutrients['VITC']['quantity'] ?? 0,
        ];

        return view('nutrition.index', compact('result'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NutritionController extends Controller
{
    public function index()
    {
        // Saat pertama kali halaman dibuka, belum ada hasil
        return view('nutrition.index', ['result' => null]);
    }

    public function analyze(Request $request)
    {
        $food = $request->input('food');

        // Karena masih testing lokal, masukkan langsung
        $appId = 'e8cefced';
        $appKey = '8a011b7ccd9f1e8065d869324f0081a4';

        // Panggil API Edamam
        $response = Http::get('https://api.edamam.com/api/nutrition-data', [
            'app_id' => $appId,
            'app_key' => $appKey,
            'ingr' => $food,
        ]);

        if (!$response->successful()) {
            return back()->withErrors(['msg' => 'Gagal mengambil data nutrisi dari API.']);
        }

        $data = $response->json();
        $nutrients = $data['ingredients'][0]['parsed'][0]['nutrients'] ?? [];

        // Ambil poin-poin utama
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

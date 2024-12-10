<?php

// App\Http\Controllers\ServiceController.php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        try {
            $divisions = Division::all();
            return response()->json($divisions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue: ' . $e->getMessage()], 500);
        }
    }
}



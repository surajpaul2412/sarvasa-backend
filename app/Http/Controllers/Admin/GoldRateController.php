<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoldRate;

class GoldRateController extends Controller
{
    public function index()
    {
        $goldRates = GoldRate::latest()->paginate(10);
        return view('admin.goldRates.index', compact('goldRates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'rate' => 'required|numeric|min:0',
        ]);

        GoldRate::create($request->only('date', 'rate'));

        return redirect()->route('goldRate.index')->with('success', 'Gold rate created successfully.');
    }

    public function edit($id)
    {
        $goldRate = GoldRate::findOrFail($id);
        return view('admin.goldRates.edit', compact('goldRate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'rate' => 'required|numeric|min:0',
        ]);

        $goldRate = GoldRate::findOrFail($id);
        $goldRate->update($request->only('date', 'rate'));

        return redirect()->route('goldRate.index')->with('success', 'Gold rate updated successfully.');
    }

    public function destroy($id)
    {
        $goldRate = GoldRate::findOrFail($id);
        $goldRate->delete();

        return redirect()->route('goldRate.index')->with('success', 'Gold rate deleted successfully.');
    }


    // API
    public function getLatestGoldRate()
    {
        // Fetch the latest gold rate
        $latestGoldRate = GoldRate::latest('date')->first();

        // Check if a gold rate exists
        if ($latestGoldRate) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $latestGoldRate->id,
                    'date' => $latestGoldRate->date,
                    'rate' => $latestGoldRate->rate,
                ],
            ], 200);
        }

        // Return an error response if no gold rate is found
        return response()->json([
            'success' => false,
            'message' => 'No gold rate found.',
        ], 404);
    }
}

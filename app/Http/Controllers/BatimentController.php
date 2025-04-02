<?php

namespace App\Http\Controllers;
use App\Models\Batiment;
use App\Models\City;
use Illuminate\Http\Request;

class BatimentController extends Controller
{
    public function index()
    {
        $batiments = Batiment::paginate(10);
        return view('pages.batiments.index', compact('batiments'));
    }

    public function create()
    {
        $cities = City::all();
        return view('pages.batiments.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'nbr_cabine' => 'required|integer',
            'description' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
        ]);

        Batiment::create($request->all());

        return redirect()->route('batiments.index')->with('success', 'Batiment created successfully.');
    }

    public function show(Batiment $batiment)
    {
        return view('pages.batiments.show', compact('batiment'));
    }

    public function edit(Batiment $batiment)
    {
        $cities = City::all();
        return view('pages.batiments.edit', compact('batiment', 'cities'));
    }

    public function update(Request $request, Batiment $batiment)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'nbr_cabine' => 'required|integer',
            'sexe' => 'required|string',
            'description' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
        ]);

        $batiment->update($request->all());

        return redirect()->route('batiments.index')->with('success', 'Batiment updated successfully.');
    }

    public function destroy(Batiment $batiment)
    {
        $batiment->delete();
        return redirect()->route('batiments.index')->with('success', 'Batiment deleted successfully.');
    }
}

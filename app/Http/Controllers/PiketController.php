<?php

namespace App\Http\Controllers;

use App\Models\Piket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PiketController extends Controller
{
/**
 * Display a listing of the resource.
 */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $piket = Piket::where('id_user', '!=', Auth::id())->paginate(5);
        } else {
            $piket = Piket::where('id_user', Auth::id())->paginate(5);
        }

        return view('admin.piket.index', compact('piket'));
    }

/**
 * Show the form for creating a new resource.
 */
    public function create()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.piket.index')->with('error', 'Admin tidak dapat membuat piket');
        }

        return view('admin.piket.index');
    }

/**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jam_mulai' => 'required',
            'jam_berakhir' => 'required',
            'keterangan' => 'required|string|max:255',
        ]);

        $piket = new Piket();
        $piket->jam_mulai = $request->jam_mulai;
        $piket->jam_berakhir = $request->jam_berakhir;
        $piket->keterangan = $request->keterangan;
        $piket->id_user = Auth::id();

        $piket->save();

        return redirect()->route('piket.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Piket $piket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Piket $piket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Piket $piket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Piket $piket)
    {
        //
    }
}

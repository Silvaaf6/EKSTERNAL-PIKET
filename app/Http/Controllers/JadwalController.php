<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $jadwal = Jadwal::select('hari')->distinct()->paginate(5);
        } elseif (auth()->user()->hasRole('user')) {
            $jadwal = Jadwal::with('user')
                ->select('hari', 'id_user')
                ->get()
                ->groupBy('hari');
        }

        return view('admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::role('user')->get();
        return view('admin.jadwal.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        ], [
            'id_user.required' => 'ID user harus diisi',
            'hari.required' => 'Hari harus dipilih',
            'hari.in' => 'Hari yang dipilih tidak valid',
        ]);

        $idUser = (int) $request->id_user;

        $hari = $request->hari;
        $jadwal = new Jadwal();
        $jadwal->id_user = $idUser;
        $jadwal->hari = $hari;
        $jadwal->save();

        Alert::success('Sukses', 'Data Berhasil Ditambah!')->autoClose(1000);
        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     */

    public function show($hari)
    {
        $jadwal = Jadwal::where('hari', $hari)
            ->whereHas('user', function ($query) {
                $query->role('user'); // filter user yang memiliki role 'user'
            })
            ->with('user')
            ->get();

        return view('admin.jadwal.show', compact('jadwal', 'hari'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('jadwals')->where('id_user', $id)->delete();

        Alert::success('Sukses', 'User berhasil dihapus dari jadwal piket!')->autoClose(1000);
        return redirect()->route('jadwal.index');
    }
}

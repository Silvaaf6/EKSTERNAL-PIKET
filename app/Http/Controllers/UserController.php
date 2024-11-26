<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Karyawan;
use App\Models\Piket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function home()
    // {
    //     $user = auth()->user()->load('karyawan');
    //     return view('home', compact('user'));
    // }

    public function home()
    {
        $piket = Piket::with('user')->get();
        $totalUsers = User::role('user')->count(); // Hitung hanya user dengan role 'user'
        return view('home', compact('totalUsers', 'piket'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::role('user')->with('karyawan')->get();
        return view('admin.karyawan.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nik' => 'required|max:16|unique:karyawans,nik',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'agama' => 'required',
            'alamat' => 'required|max:500',
            'jenis_kelamin' => 'required|in:perempuan,laki-laki',
            'no_telp' => 'required|max:15',
            'cover' => 'required|mimes:jpg,jpeg,png|max:65535',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'nik.required' => 'NIK harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi',
            'agama.required' => 'Agama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'no_telp.required' => 'No telepon harus diisi',
            'cover.required' => 'Foto harus diisi',
        ]);

        // INI UNTUK MEMBUAT USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        // INI UNTUK MEMBUAT KARYAWAN / PROFILE NYA
        $karyawan = new Karyawan([
            'id_user' => $user->id,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
        ]);

        // INI BUAT UPLOAD GAMBAR
        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = time() . '-' . $img->getClientOriginalName();
            $img->move(public_path('images/karyawan/'), $name);
            $karyawan->cover = $name; // Simpan nama file di kolom cover
        }

        $karyawan->save();

        Alert::success('Sukses', 'Data Berhasil Ditambah!')->autoClose(1000);
        return redirect()->route('karyawan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $karyawan = Karyawan::where('id_user', $id)->first();

        return view('admin.karyawan.show', compact('user', 'karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::with('karyawan')->find($id);
        return view('admin.karyawan.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'nik' => 'required|max:16',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'agama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:perempuan,laki-laki',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $karyawan = $user->karyawan;
        $karyawan->nik = $request->input('nik');
        $karyawan->tempat_lahir = $request->input('tempat_lahir');
        $karyawan->tgl_lahir = $request->input('tgl_lahir');
        $karyawan->agama = $request->input('agama');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->jenis_kelamin = $request->input('jenis_kelamin');

        // BUAT UPLOAD GAMBAR
        if ($request->hasFile('cover')) {
            // INI BUAT HAPUS GAMBAR LAMA JIKA ADA YANG BARU
            if ($karyawan->cover && file_exists(public_path('images/karyawan/' . $karyawan->cover))) {
                unlink(public_path('images/karyawan/' . $karyawan->cover));
            }

            // INI BUAT UPLOAD GAMBAR
            $cover = $request->file('cover');
            // INI BUAT MENYIMPAN NAMA GAMBAR MENJADI HASH
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('images/karyawan'), $coverName);

            // BUAT MENYIMPAN NAMA GAMBAR KE DATABASE
            $karyawan->cover = $coverName;
        }

        $karyawan->save();
        $user->save();

        Alert::success('Sukses', 'Data Berhasil Diubah!')->autoClose(1000);
        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        //BUAT NYARI DATA USER BERDASARKAN ID
        $user = User::findOrFail($id);

        // CARI NAMA KARYAWAN BERDASARKAN ID YANG DIPILIH
        $karyawan = Karyawan::where('id_user', $id)->first();

        // BUAT HAPUS KARYAWAN JIKA TERHUBUNG DENGAN ID USER
        if ($karyawan) {
            $karyawan->delete();
        }

        // MENGHAPUS DATA USER
        $user->delete();

        Alert::success('Sukses', 'Data Berhasil Dihapus!')->autoClose(1000);
        return redirect()->route('karyawan.index');
    }
}

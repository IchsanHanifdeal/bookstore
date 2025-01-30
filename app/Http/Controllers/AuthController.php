<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $userRole = $user->role;

            $loginTime = Carbon::now();
            $request->session()->put([
                'login_time' => $loginTime->toDateTimeString(),
                'nama' => $user->nama,
                'id' => $user->id,
                'role' => $user->role,
                'created_at' => $user->created_at,
            ]);

            if ($userRole === 'admin') {
                return redirect()->intended('dashboard')->with('toast', [
                    'message' => 'Login berhasil!',
                    'type' => 'success'
                ]);
            } elseif ($userRole === 'customer') {
                return redirect()->route('index')->with('toast', [
                    'message' => 'Login berhasil!',
                    'type' => 'success'
                ]);
            }

            return back()->with('toast', [
                'message' => 'Login gagal, role pengguna tidak dikenali.',
                'type' => 'error'
            ])->withInput();
        }

        return back()->withErrors([
            'loginError' => 'Username atau password salah.',
        ])->with('toast', [
            'message' => 'Username atau password salah.',
            'type' => 'error'
        ])->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('toast', [
            'message' => 'Logout berhasil!',
            'type' => 'success'
        ]);;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'telepon' => 'required|string|max:20',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'customer',
            ]);

            Customer::create([
                'user' => $user->id,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_telp' => $request->telepon,
            ]);

            DB::commit();

            return redirect()->route('login')->with('toast', [
                'type' => 'success',
                'message' => 'Registrasi berhasil! Silakan login.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan, silakan coba lagi.',
            ])->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

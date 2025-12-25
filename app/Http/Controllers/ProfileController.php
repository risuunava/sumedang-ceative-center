<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Tambahkan ini
use App\Models\Booking;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userBookings = Booking::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $totalBookings = Booking::where('user_id', $user->id)->count();
        
        return view('profile', compact('user', 'userBookings', 'totalBookings'));
    }
    
    public function edit()
    {
        $user = Auth::user();
        return view('profile-edit', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
    
    public function updatePassword(Request $request)
    {
        // Validasi sederhana
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'password.required' => 'Password baru harus diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
        ]);
        
        $user = Auth::user();
        
        // Debug logging
        Log::info('Password update attempt', [
            'user_id' => $user->id,
            'email' => $user->email,
            'has_current_password' => !empty($request->current_password),
            'current_password_match' => Hash::check($request->current_password, $user->password),
        ]);
        
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah'
            ])->withInput();
        }
        
        // Update password
        try {
            $user->password = Hash::make($request->password);
            $user->save();
            
            Log::info('Password updated successfully', ['user_id' => $user->id]);
            
            // Redirect dengan pesan sukses
            return redirect()->route('profile.index')
                ->with('success', 'Password berhasil diperbarui!');
                
        } catch (\Exception $e) {
            Log::error('Error updating password', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return back()->withErrors([
                'password' => 'Gagal memperbarui password: ' . $e->getMessage()
            ])->withInput();
        }
    }
}
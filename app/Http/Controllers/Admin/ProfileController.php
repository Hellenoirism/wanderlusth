<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // ✅ Ambil data validasi
        $data = $request->validated();

        // ❌ Jangan ikutkan password ke fill (biar tidak null)
        unset($data['password']);

        // ✅ Update basic info
        $user->fill($data);

        // ✅ Reset email verification jika berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ✅ HANDLE PASSWORD (optional)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // ✅ HANDLE FOTO PROFILE
        if ($request->hasFile('photo')) {

            // hapus foto lama (jika ada)
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // simpan foto baru
            $path = $request->file('photo')->store('profile', 'public');

            $user->profile_photo = $path;
        }

        $user->save();

        return Redirect::route('admin.profile')
            ->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

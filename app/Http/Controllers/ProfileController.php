<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(User $users)
    {
        $user = $users->find(Auth::user()->id);

        if ($user->photo) {
            $photoUrl = asset('files/photo/' . $user->photo);
            $photoExtension = pathinfo($user->photo, PATHINFO_EXTENSION);
        } else {
            $photoUrl = null;
            $photoExtension = null;
        }

        // dd($photoUrl);
        

        return view('pages.admin.profile', compact('user', 'photoUrl', 'photoExtension'));
    }

    public function update(UpdateProfileRequest $request, User $users)
    {

        $user = $users::find(Auth::user()->id);

        $newfullName = $request->input('full_name');
        $newUsername = $request->input('username');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');
        $newTelp = $request->input('telp');
        $newAddress = $request->input('address');
        $newPhoto = $request->file('photo');

        if ($newfullName === $user->full_name && $newUsername === $user->username && $newEmail === $user->email && $newTelp === $user->telp && $newAddress === $user->address && empty($newPassword) && !$newPhoto) {
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }

        $user->full_name = $request->input('full_name');
        $user->username = $request->input('username');
        $user->telp = $request->input('telp');
        $user->address = $request->input('address');

        if ($request->hasFile('photo')) {

            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('files/photo'), $photoFileName);
            if ($user->photo !== $photoFileName) {
                $user->photo = $photoFileName;
                $user->save();
            }
        }

        $user->save();

        if ($newEmail !== $user->email || $newPassword) {

            if ($newEmail !== $user->email) {
                $user->email = $newEmail;
            }

            if ($newPassword) {
                $user->password = Hash::make($newPassword);
            }

            $user->save();
            Session::flash('profile-updated', 'Data profile anda telah berubah.');
            Auth::logout();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }
    }
}

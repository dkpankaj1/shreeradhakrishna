<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        try {
            $request->user()->save();
            return Redirect::route('profile.edit')->with('success', 'Profile updated successfull');
        } catch (\Exception $e) {
            return Redirect::route('profile.edit')->with('danger', $e->getMessage());
        }
    }

    /**
     * Password Update
     */
    public function password_get(): View
    {
        return view('profile.password');
    }

    public function password_post(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => 'required|',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $user = \App\Models\User::first($request->user()->id)->first();

            if (Hash::check($request->old_password, $user->password)) {

                $user->update(['password' => Hash::make($request->password)]);
                return Redirect::route('password.edit')->with('success', 'Password update success.');

            } else {

                return Redirect::route('password.edit')->with('danger', 'Oop\'s something went wrong.');
                
            }

        } catch (\Exception $e) {
            return Redirect::route('password.edit')->with('danger', $e->getMessage());

        }




    }
}
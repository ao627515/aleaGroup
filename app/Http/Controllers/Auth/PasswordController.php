<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // dd(request()->all(), request()->user()->isUser());
        $validated = $request->validate([
            'current_password' => [
                Rule::requiredIf(function () {
                    return request()->user()->isUser();
                }),
                'nullable',
                'current_password'
            ],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);


        $request->user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return  to_route('user.show',  $request->user())->with('success', 'Mot de passe modifier !');
    }
}

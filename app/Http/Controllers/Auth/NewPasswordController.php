<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use function Laravel\Prompts\password;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(string $token, Request $request): View
    {
        abort_if(empty(User::getTokenSingle($request->token)), 404);

        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(string $token, Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::getTokenSingle($token);

        if (!empty($user)) {

            $user->update([
                'password' => Hash::make($data["password"]),
                'remember_token' => null
            ]);

            return to_route('login')->with('success', __("Mot de passe réinitialisé avec succès."));
        }else{
            return back()->with('error', __("Aucun utilisateur trouvé !"));
        }
    }
}

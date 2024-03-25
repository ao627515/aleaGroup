<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $data['page_title'] = 'Profile';
        $data['header_title'] = 'Profile';
        $data['user'] = $user;
        $data['records'] = User::getRecords(search: true, filter: true, paginate: 15);
        $data['isUsersListPage'] = request()->has('f_search_name');

        return view('users.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required' , 'numeric', 'string', Rule::unique('users', 'phone')->ignore($user->id, 'id')],
            'role' => ['nullable', 'string', 'in:user,admin']
        ]);

        $data['name'] = strtolower($data['name']);

        $user->update($data);

        return to_route('user.show', $user)->with('success', 'Modification reussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return to_route('user.show', auth()->user())->with('success', 'Suppression reussie !');
    }

    public function destroyAccount(Request $request){

        /** @var  $user App\Models\User;*/
        $user = auth()->user();

        AuthenticatedSessionController::middlewarelogout($request);

        $user->delete();

        return to_route('login');

    }
}

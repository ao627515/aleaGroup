<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Lstes des évènements';
        $data['header_title'] = 'Listes des évènements';

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data['page_title'] = 'Lstes des évènements';
        $data['header_title'] = '';
        $data['user'] = $user;

        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required' , 'numeric', 'string', Rule::unique('users', 'phone')->ignore($user->id, 'id')],
            'role' => ['required', 'string', 'in:user,admin']
        ]);


        $user->update($data);

        return to_route('user.show', $user)->with('success', 'Modification reussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

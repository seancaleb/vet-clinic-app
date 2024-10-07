<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $users = User::with('appointments')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {
        $current_user = Auth::user();

        if ($current_user->role !== 'admin') {
            abort(403, "You don't access rights to edit this resource.");
        }

        request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'role' => ['required'],
        ]);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'role' => request('role'),
        ]);

        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {
        //
    }
}

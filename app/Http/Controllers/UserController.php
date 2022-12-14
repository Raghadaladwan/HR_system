<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\DeleteRequest;
use App\Http\Requests\Users\IndexRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $users = User::with('details')->paginate(20);

        return response()->json([
            'status' => 'success',
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->only('name', 'email', 'contact', 'job_title', 'status');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->name . '12345')
        ]);

        $user->details()->create([
            'contact' => $request->contact,
            'job_title' => $request->job_title,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User Added Successfully',
            'user' => $user,
            'details' => $user->details
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $userData = $request->only('name', 'email');
        $details = $request->only('contact', 'job_title', 'status');

        $user->update($userData);
        $user->details()->update($details);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user,
            'role' => $user->details,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
            'user' => $user,
        ]);
    }

    public function updateContact(UpdateRequest $request)
    {
        $user = Auth::user();

        $details = $request->only('contact');

        $user->details()->update($details);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user,
            'details' => $user->details,
        ]);
    }
}

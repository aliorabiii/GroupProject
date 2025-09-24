<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminManagementController extends Controller
{
    // Show all users and roles (for Super Admin)
    public function index()
    {
        $users = User::all();

        // Include all roles except 'super-admin' for normal users
        $roles = Role::pluck('name', 'name');

        return view('superadmin.admins.index', compact('users', 'roles'));
    }

    // Show create user form
    public function create()
    {
        

        // Super-admin can assign any role including super-admin
        $roles = Role::pluck('name', 'name');

        return view('superadmin.admins.create', compact('roles'));
    }

    // Store new user
    public function store(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        // Ensure only super-admin can assign 'super-admin'
        if ($request->role === 'super-admin' && !auth()->user()->hasRole('super-admin')) {
            return redirect()->back()->withErrors(['role' => 'Unauthorized to assign this role.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'User created successfully!');
    }

    // Show edit user form
    public function edit(User $admin)
    {
        

        $roles = Role::pluck('name', 'name'); // Super-admin can assign any role

        return view('superadmin.admins.edit', compact('admin', 'roles'));
    }

    // Update user
    public function update(Request $request, User $admin)
    {
        

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        // Prevent non-super-admin from assigning super-admin
        if ($request->role === 'super-admin' && !auth()->user()->hasRole('super-admin')) {
            return redirect()->back()->withErrors(['role' => 'Unauthorized to assign this role.']);
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $admin->password,
        ]);

        $admin->syncRoles([$request->role]);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin updated successfully!');
    }

    // Delete user
    public function destroy(User $admin)
    {
        

        // Prevent deleting self
        if ($admin->id === auth()->id()) {
            return redirect()->route('superadmin.admins.index')
                ->with('error', 'You cannot delete yourself!');
        }

        $admin->delete();

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin deleted successfully!');
    }

    // Add new role dynamically
    public function addRole(Request $request)
    {
       

        $request->validate([
            'role_name' => 'required|string|max:50|unique:roles,name',
        ]);

        Role::create(['name' => $request->role_name]);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Role created successfully!');
    }

    // ✅ Helper method to authorize Super Admin
    private function authorizeSuperAdmin()
    {
        if (!auth()->user()->hasRole('super-admin')) {
            abort(403, 'Unauthorized');
        }
    }
}

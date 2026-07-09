<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $customers = User::customers()->latest()->get();

        $total    = $customers->count();
        $counts   = $customers->countBy('is_active');
        $aktif    = $counts->get(true, 0);
        $nonaktif = $counts->get(false, 0);

        return view('admin.users.index', compact('customers', 'total', 'aktif', 'nonaktif'));
    }

    public function update(Request $request, User $user)
    {
        $user->update(['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.users.index')->with('success', 'Status user berhasil diubah.');
    }
}
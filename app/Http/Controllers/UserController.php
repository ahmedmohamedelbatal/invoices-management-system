<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'image' => ['required', 'image', 'max:10000'],
        ], [
            'name.required' => 'يرجى ادخال الاسم',
            'email.required' => 'يرجى ادخال البريد الالكترونى',
            'image.required' => 'يرجى ادخال الصورة الشخصية',
        ]);

        $user = User::findorFail(Auth::user()->id);

        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('profile-images', $image, 'public_path');
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $path,
        ]);

        session()->flash('edit','تم تعديل بيانات الحساب بنجاج');
        return redirect('profile');
    }

    public function change_password(Request $request) {
        $user = User::findorFail(Auth::user()->id);

        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            session()->flash('edit','تم تعديل كلمة المرور بنجاج');
            return redirect('profile');
        } else {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير متطابقة']);
        }
    }
}

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
      'image' => ['image', 'max:10000'],
    ], [
      'name.required' => 'يرجى ادخال الاسم',
      'email.required' => 'يرجى ادخال البريد الالكترونى',
      'image.image' => 'يرجى ادخال الصورة الشخصية بصيغة صحيحة',
    ]);

    $user = User::findorFail(Auth::user()->id);

    if ($request->hasFile('image')) {
      $image = $request->file('image')->getClientOriginalName();
      $path = $request->file('image')->storeAs('profile-images', $image, 'public_path');
    } else {
      $path = null;
    }

    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'image' => $path,
    ]);

    session()->flash('edit', 'تم تعديل بيانات الحساب بنجاح');
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

      session()->flash('edit', 'تم تعديل كلمة المرور بنجاح');
      return redirect('profile');
    } else {
      return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير متطابقة']);
    }
  }
}

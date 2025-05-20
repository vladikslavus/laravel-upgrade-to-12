<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);


        if (Auth::attempt($data)) {
            return redirect()->intended('profile');
        }

        return back()->withErrors(['email' => 'Неверные учётные данные']);
    }

    public function logOut()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('login')->withErrors('status', 'Регистрация прошла успешно');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name'  => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . Auth::id(), // добавляем исключение текущего пользователя.
            // Емэйл должен быть уникальным, но допустимо использование емэйла данного пользователя
        ]);

        // Получаем авторизованного пользователя
        $user = Auth::user();
        ($user instanceof User) && $user->update($data); // Явная проверка типа, т.е. если $user является экземпляром класса User

        return redirect()->route('profile');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        // Получаем авторизованного пользователя
        $user = Auth::user();

        // Делаем проверку Если пользователь ввёл правильный прошлый пароль
        // Сравниваем пароль, который он прислал с текушим в базе
        if (!Hash::check($data['current_password'], $user->password)) { // сравниваем хэши
            return back()->withErrors(['current_password' => 'Текущий пароль не верен!']);
        }

        $user->password = Hash::make($data['new_password']);
        ($user instanceof User) && $user->save(); // Тоже самое только без $data – явная проверка типа, т.е. если $user является экземпляром класса User

        return redirect()->route('profile')->with(['status' => 'Пароль успешно изменён!']);
    }
}

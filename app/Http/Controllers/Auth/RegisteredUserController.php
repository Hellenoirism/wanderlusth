<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Closure;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email:rfc,dns',
                'max:255',
                Rule::unique(User::class),

                function (string $attribute, mixed $value, Closure $fail) {
            
                    $commonTypos = [
                        'gmail.cm',
                        'gmail.con',
                        'gmail.co',
                        'gmail.cim',
                        'gamil.com',
            
                        'yahoo.cm',
                        'yahoo.con',
            
                        'outlook.cm',
                        'hotmail.cm',
            
                        'yopmail.cm',
                    ];
            
                    $domain = strtolower(substr(strrchr($value, '@'), 1));
            
                    if (in_array($domain, $commonTypos)) {
                        $fail('Domain email tampaknya salah ketik.');
                    }
                },
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin.dashboard', absolute: false));
    }
}

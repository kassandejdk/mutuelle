<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->validated();
        // if (! Auth::attempt($request->only('matricule', 'password'), $request->boolean('remember')) || ! Auth::user()->hasRole($request->role)) {
        if (! Auth::attemptWhen($request->only('matricule', 'password'), function (User $user) use ($request) {
            return $user->hasRole($request->role);
        },$request->boolean('remember'))) {
            RateLimiter::hit($request->throttleKey());
            return back()->with('error', 'Identifiants incorrects...')->onlyInput('matricule');
        }


        RateLimiter::clear($request->throttleKey());

        $request->session()->regenerate();
        return redirect()->intended(routeur($request->role));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

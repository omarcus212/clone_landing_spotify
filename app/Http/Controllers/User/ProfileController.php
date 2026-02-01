<?php

namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\StoreUserUpdate;
use App\Models\User;
use App\Services\AuthService;
use Auth;
use Illuminate\Http\Request;
use Password;

class ProfileController
{
    public function showProfile()
    {
        $user = Auth::user();

        App::setLocale(session('locale', 'en'));

        $musics = json_decode(
            file_get_contents(resource_path('data/musics.json')),
            true
        );

        return view('user/profile', compact('user', 'musics'));

    }

    public function profileUpdate(StoreUserUpdate $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if (
            ($data['name'] ?? $user->name) === $user->name &&
            ($data['email'] ?? $user->email) === $user->email
        ) {
            return back()->with('info', __('message.no_changes_made'));
        }

        $user->update($data);

        return back()->with('success', __('message.profile_updated_successfully'));
    }

    public function deactivate(Request $request, AuthService $authService)
    {
        $user = Auth::user();

        $user->update(['active' => false,]);

        $authService->logout($request);

        return redirect()
            ->route('login');
    }

    public function sendResetLink(Request $request, AuthService $authService)
    {
        $user = Auth::user();

        $status = Password::sendResetLink([
            'email' => $user->email
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            $authService->logout($request);

            return redirect()->route('login')
                ->with('status', __('message.password_reset_link_sent'));
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }


}

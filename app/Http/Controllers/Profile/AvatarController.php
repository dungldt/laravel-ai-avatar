<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateAvatarRequest;

class AvatarController extends Controller
{
    /**
     * Update user avatar
     */
    public function update(UpdateAvatarRequest $request): RedirectResponse
    {
        $path = $request->file('avatar')->store('avatars', 'public');
        auth()->user()->update(['avatar' => $path]);

        return Redirect::route('profile.edit')->with('status', 'Avatar updated!');
    }
}

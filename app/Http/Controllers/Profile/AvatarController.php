<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    /**
     * Update user avatar
     */
    public function update(UpdateAvatarRequest $request): RedirectResponse
    {
        $path = Storage::disk('public')->putFile('avatars', $request->file('avatar'));

        $oldAvatar = $request->user()?->avatar ?? null;
        if ($oldAvatar) { // old avatar
            Storage::disk('public')->delete($oldAvatar); 
        }

        auth()->user()->update(['avatar' => $path]);

        return Redirect::route('profile.edit')->with('status', 'Avatar updated!');
    }
}

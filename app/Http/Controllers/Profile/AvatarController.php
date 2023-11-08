<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class AvatarController extends Controller
{
    /**
     * Update user avatar
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image',
        ]);

        return Redirect::route('profile.edit')->with('status', 'Avatar updated!');
    }
}

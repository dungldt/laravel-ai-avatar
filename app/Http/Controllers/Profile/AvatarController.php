<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

        return Redirect::route('profile.edit')->with('status', 'Avatar is updated!');
    }

    /**
     * Generate user avatar
     */
    public function generate(Request $request): RedirectResponse
    {
        $result = OpenAI::images()->create([
            'prompt' => "developer avatar",
            'size' => "512x512",
            'quality' => "standard",
            'n' => 1,
        ]);
        $content = file_get_contents($result->data[0]->url);
        $filename = Str::random(25);
        $path = "avatars/$filename.jpg";

        Storage::disk('public')->put($path, $content);

        $oldAvatar = $request->user()?->avatar ?? null;
        if ($oldAvatar) { // old avatar
            Storage::disk('public')->delete($oldAvatar); 
        }

        auth()->user()->update(['avatar' => $path]);

        return Redirect::route('profile.edit')->with('status', 'Generate successfully. Avatar is updated!');
    }
}

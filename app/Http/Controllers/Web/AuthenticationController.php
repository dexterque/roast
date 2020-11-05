<?php


namespace App\Http\Controllers\Web;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    public function getSocialRedirect($account)
    {
        try {
            return Socialite::with($account)->redirect();
        } catch (\InvalidArgumentException $exception) {
            return redirect("/login");
        }
    }

    public function getSocialCallback($account, User $newUser)
    {
        $socialUser = Socialite::with($account)->user();
        $user = User::where("provider_id", $socialUser->id)
            ->where("provider", $account)
            ->first();
        if (null == $user) {
            $newUser->name        = $socialUser->getName();
            $newUser->email       = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar      = $socialUser->getAvatar();
            $newUser->password    = '';
            $newUser->provider    = $account;
            $newUser->provider_id = $socialUser->getId();
            $newUser->save();
            $user = $newUser;
        }
        Auth::login($user);
        return redirect('/');
    }
}

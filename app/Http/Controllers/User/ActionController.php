<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use TimeHunter\LaravelGoogleReCaptchaV3\Facades\GoogleReCaptchaV3;
use Validator;
// Models //
use App\Models\User;
// Mailables //
use App\Mail\AccountActivation;
use App\Mail\ChangedPassword;
use App\Mail\PasswordRecovery;

class ActionController extends Controller
{
    // GUEST ACTIONS //
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'          => ['bail', 'required'],
            'phoneNumber'   => ['bail', 'required', 'phone'],
            'country_id'    => ['bail', 'required'],
            'email'         => ['bail', 'required', 'email', 'unique:users'],
            'password'      => ['bail', 'required', 'min:6', 'confirmed'],
            'token'         => ['bail', 'required']
        ]);
        if($validator->stopOnFirstFailure()->fails()) {
            return $this->getValidationError($validator);
        }
        if(!GoogleReCaptchaV3::setAction('submit')->verifyResponse($request->token, request()->ip())->isSuccess()) {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please, try again later.']);
        }
        $user = User::create([
            'uuid'                  => (string) Str::uuid(),
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'name'                  => $request->name,
            'phoneNumber'           => $request->phoneNumber,
            'country_id'            => $request->country_id,
            'activationKey'         => (string) Str::uuid(),
            'forgottenPasswordKey'  => null
        ]);
        Mail::to($user->email)->send(new AccountActivation($user->uuid, $user->activationKey));
        $user->logActivity('Registered.');
        return response()->json(['success' => true]);
    }

    public function activate($uuid, $activationKey) {
        $user = User::where('uuid', $uuid)->first();
        if(empty($user) || $user->activationKey != $activationKey) {
            return redirect('/login');
        }
        $user->update(['activationKey' => null]);
        auth()->loginUsingId($user->id);
        auth()->user()->logActivity('Activated account.');
        return redirect('/');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'     => ['bail', 'required', 'email'],
            'password'  => ['bail', 'required'],
            'token'     => ['bail', 'required']
        ]);
        if($validator->stopOnFirstFailure()->fails()) {
            return $this->getValidationError($validator);
        }
        if(!GoogleReCaptchaV3::setAction('submit')->verifyResponse($request->token, request()->ip())->isSuccess()) {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please, try again later.']);
        }
        $user = User::where('email', $request->email)->first();
        if(empty($user)) {
            return response()->json(['success' => false, 'message' => 'Wrong e-mail or password.']);
        }
        if(auth()->attempt($request->only('email', 'password'))) {
            if(!auth()->user()->isActive()) {
                auth()->user()->logActivity('Failed login attempt. Inactive account.');
                auth()->logout();
                return response()->json(['success' => false, 'message' => 'Your account is not active. Please, check your e-mail for further instructions.']);
            }
            auth()->user()->logActivity('Logged in.');
            return response()->json(['success' => true]);
        }
        $user->logActivity('Failed login attempt. Wrong password.');
        return response()->json(['success' => false, 'message' => 'Wrong e-mail or password.']);
    }

    public function submitForgottenPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['bail', 'required', 'email'],
            'token' => ['bail', 'required']
        ]);
        if($validator->stopOnFirstFailure()->fails()) {
            return $this->getValidationError($validator);
        }
        if(!GoogleReCaptchaV3::setAction('submit')->verifyResponse($request->token, request()->ip())->isSuccess()) {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please, try again later.']);
        }
        $user = User::where('email', $request->email)->first();
        if(!empty($user) && $user->isActive()) {
            $user->update(['forgottenPasswordKey' => (string) Str::uuid()]);
            Mail::to($user->email)->send(new PasswordRecovery($user->uuid, $user->forgottenPasswordKey));
            $user->logActivity('Initiated password recovery.');
        }
        return response()->json(['success' => true]);
    }

    public function changeForgottenPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'uuid'                  => ['bail', 'required', 'uuid'],
            'forgottenPasswordKey'  => ['bail', 'required', 'uuid'],
            'password'              => ['bail', 'required', 'min:6', 'confirmed'],
            'token'                 => ['bail', 'required']
        ]);
        if($validator->stopOnFirstFailure()->fails()) {
            return $this->getValidationError($validator);
        }
        if(!GoogleReCaptchaV3::setAction('submit')->verifyResponse($request->token, request()->ip())->isSuccess()) {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please, try again later.']);
        }
        $user = User::where('uuid', $request->uuid)->first();
        if(empty($user) || $user->forgottenPasswordKey != $request->forgottenPasswordKey) {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please, try again later.']);
        }
        $user->update([
            'password'              => bcrypt($request->password),
            'forgottenPasswordKey'  => null
        ]);
        Mail::to($user->email)->send(new ChangedPassword());
        $user->logActivity('Changed forgotten password.');
        return response()->json(['success' => true]);
    }

    // USER ACTIONS //
    public function logout(Request $request) {
        auth()->user()->logActivity('Logged out.');
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Account //
    public function updateAccount(Request $request) {
        $validator = Validator::make($request->all(), [
            // Validators //
        ]);
        if($validator->stopOnFirstFailure()->fails()) {
            return $this->getValidationError($validator);
        }
        // $user->logActivity('ACTIVITY MESSAGE');
        // return response()->json(['success' => true]);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            // Validators //
        ]);
        if($validator->stopOnFirstFailure()->fails()) {
            return $this->getValidationError($validator);
        }
        // Mail::to(auth()->user()->email)->send(new ChangedPassword());
        // $user->logActivity('ACTIVITY MESSAGE');
        // return response()->json(['success' => true]);
    }
}

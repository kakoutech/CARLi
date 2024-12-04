<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Notifications\AccountCreatedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'account_type' => ['required', 'string', 'in:learner,trainer,employer'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = new User();
        $user->account_type = $input['account_type'];
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);

        if ($input['account_type'] == 'learner') {
            Validator::make($input, [
                'learner_phone_number' => ['required', 'string', 'max:255'],
                'work_place' => ['required', 'string', 'max:255'],
                'manager_name' => ['required', 'string', 'max:255'],
                'reflection_activity_date' => ['required', 'string', 'max:255'],
                'reflection_activity_postcode' => ['required', 'string', 'max:255'],
            ])->validate();

            $user->phone_number = $input['learner_phone_number'];
            $user->work_place = $input['work_place'];
            $user->manager_name = $input['manager_name'];
            $user->reflection_activity_date = Carbon::createFromFormat('Y-m-d', $input['reflection_activity_date']);
            $user->reflection_activity_postcode = $input['reflection_activity_postcode'];
        }

        if ($input['account_type'] == 'trainer') {
            Validator::make($input, [
                'course' => ['required', 'string', 'max:255'],
            ])->validate();

            $user->course = $input['course'];
        }

        if ($input['account_type'] == 'employer') {
            Validator::make($input, [
                'company_name' => ['required', 'string', 'max:255'],
                'service_type' => ['required', 'string', 'max:255'],
                'employer_phone_number' => ['required', 'string', 'max:255'],
                'reporting_preference' => ['required', 'string', 'max:255'],
            ])->validate();

            $user->company_name = $input['company_name'];
            $user->service_type = $input['service_type'];
            $user->phone_number = $input['employer_phone_number'];
            $user->reporting_preference = $input['reporting_preference'];
        }

        $user->save();

        $user->notify(new AccountCreatedNotification($user));

        return $user;
    }
}

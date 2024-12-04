@extends('layouts.guest')

@section('content')

    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="logo"/></a>

    <form x-data="{ tab: 'learner' }" method="POST" action="{{ route('register') }}" class="login-form">

        @csrf

        <input type="hidden" x-model="tab" id="account_type" name="account_type" value="{{ old('account_type', 'learner') }}"/>

        <div class="w-full grid grid-cols-3 rounded-t overflow-hidden">
            <div :class="{ 'bg-brand-700': tab === 'learner' }" @click.prevent="tab = 'learner'" class="text-lg text-center text-white px-4 py-2 bg-brand-500 bg-brand-700">Learner</div>
            <div :class="{ 'bg-brand-700': tab === 'employer' }" @click.prevent="tab = 'employer'" class="text-lg text-center text-white px-4 py-2 bg-brand-500">Employer</div>
            <div :class="{ 'bg-brand-700': tab === 'trainer' }" @click.prevent="tab = 'trainer'" class="text-lg text-center text-white px-4 py-2 bg-brand-500">Trainer</div>
        </div>

        <div class="bg-gray-100 py-10 px-10 rounded">

            <div class="mt-4">
            
                <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
            
                <div class="mt-1">
            
                    <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('first_name') }}">
            
                </div>
            
                @error('first_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
            </div>

            <div class="mt-4">
            
                <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
            
                <div class="mt-1">
            
                    <input type="text" name="last_name" id="last_name" autocomplete="surname" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('last_name') }}">
            
                </div>
            
                @error('last_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
            </div>

            <div class="mt-4">
            
                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
            
                <div class="mt-1">
            
                    <input type="email" name="email" id="email" autocomplete="email" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('email') }}">
            
                </div>
            
                @error('email') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
            </div>
            
            <div class="mt-4">
            
                <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
            
                <div class="mt-1">
            
                    <input type="password" name="password" id="password" autocomplete="password" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
            
                </div>
            
                @error('password') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
            </div>

            <div class="mt-4">
            
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700"> Password Confirmation </label>
            
                <div class="mt-1">
            
                    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="password_confirmation" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
            
                </div>
            
                @error('password_confirmation') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
            </div>

            <div x-show="tab === 'learner'">

                <div class="mt-4">
                
                    <label for="learner_phone_number" class="block text-sm font-medium text-gray-700"> Phone Number </label>
                
                    <div class="mt-1">
                
                        <input type="tel" name="learner_phone_number" id="learner_phone_number" autocomplete="phone_number" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('learner_phone_number') }}">
                
                    </div>
                
                    @error('learner_phone_number') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="mt-4">
                
                    <label for="work_place" class="block text-sm font-medium text-gray-700"> Work Place </label>
                
                    <div class="mt-1">
                
                        <input type="text" name="work_place" id="work_place" autocomplete="work_place" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('work_place') }}">
                
                    </div>
                
                    @error('work_place') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="mt-4">
                
                    <label for="manager_name" class="block text-sm font-medium text-gray-700"> Manager Name </label>
                
                    <div class="mt-1">
                
                        <input type="text" name="manager_name" id="manager_name" autocomplete="manager_name" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('manager_name') }}">
                
                    </div>
                
                    @error('manager_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="mt-4">
                
                    <label for="reflection_activity_date" class="block text-sm font-medium text-gray-700"> Reflection Activity Date </label>
                
                    <div class="mt-1">
                
                        <input type="date" name="reflection_activity_date" id="reflection_activity_date" autocomplete="reflection_activity_date" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('reflection_activity_date') }}">
                
                    </div>

                    <small>Enter date for prompting reflection activity.</small>
                
                    @error('reflection_activity_date') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

                <div class="mt-4">
                
                    <label for="reflection_activity_postcode" class="block text-sm font-medium text-gray-700"> Reflection Activity Postcode </label>
                
                    <div class="mt-1">
                
                        <input type="text" name="reflection_activity_postcode" id="reflection_activity_postcode" autocomplete="reflection_activity_postcode" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('reflection_activity_postcode') }}">
                
                    </div>

                    <small>Enter date for prompting reflection activity.</small>

                    @error('reflection_activity_postcode') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>

            </div>

            <div x-show="tab === 'employer'">
            
                <div class="mt-4">
            
                    <label for="company_name" class="block text-sm font-medium text-gray-700"> Company Name </label>
            
                    <div class="mt-1">
            
                        <input type="text" name="company_name" id="company_name" autocomplete="company_name" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
            
                    </div>
            
                    @error('company_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
                </div>
            
                <div class="mt-4">
            
                    <label for="service_type" class="block text-sm font-medium text-gray-700"> Service Type </label>
            
                    <div class="mt-1">
            
                        <input type="text" name="service_type" id="service_type" autocomplete="service_type" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
            
                    </div>
            
                    @error('service_type') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
                </div>
            
                <div class="mt-4">
            
                    <label for="employer_phone_number" class="block text-sm font-medium text-gray-700"> Employer Main Contact Number </label>
            
                    <div class="mt-1">
            
                        <input type="tel" name="employer_phone_number" id="employer_phone_number" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
            
                    </div>
            
                    @error('employer_phone_number') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
                </div>

                <div class="mt-4">
                
                    <label for="reporting_preference" class="block text-sm font-medium text-gray-700"> Reporting Preference </label>
                
                    <div class="mt-1">
                
                        <select name="reporting_preference" id="reporting_preference" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">

                            <option value="">-- Choose --</option>
                            @foreach (getReportingPreferences() as $preference)
                                <option value="{{ $preference['value'] }}">{{ $preference['name'] }}</option>
                            @endforeach
                        </select>
                
                    </div>
                
                    @error('reporting_preference') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
            
            </div>

            <div x-show="tab === 'trainer'">
            
                <div class="mt-4">
            
                    <label for="course" class="block text-sm font-medium text-gray-700"> Course/Cohort </label>
            
                    <div class="mt-1">
            
                        <select name="course" id="course" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
            
                            <option value="">-- Choose Course/Cohort  --</option>
                            @foreach (getCoursePreferences() as $preference)
                                <option value="{{ $preference['value'] }}">{{ $preference['name'] }}</option>
                            @endforeach
                        </select>
                        
                    </div>
            
                    @error('course') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
            
                </div>
            
            </div>

        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4 text-center">
                <x-jet-label for="terms">
                    <div class="flex items-center justify-center">
                        <x-jet-checkbox name="terms" id="terms" required />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
        @endif

        <div class="flex items-center justify-center mt-4">
        
            <button type="submit" class="block button w-full">Register</button>
        
        </div>

        <div class="flex items-center justify-center mt-6">
        
            <a href="{{ route('login') }}" class="underline text-lg text-gray-600 hover:text-gray-900">Already Registered?</a>
        
        </div>

    </form>

@endsection
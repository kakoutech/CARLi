<form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">

    <div class="space-y-8 divide-y divide-gray-200">

        <div>

            <div>

                <h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>

                <p class="mt-1 text-sm text-gray-500">Fill in the form below to update the user.</p>

            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-6">

                    <label for="photo" class="block text-sm font-medium text-gray-700"> Photo </label>

                    <div class="mt-1 flex items-center">

                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">

                            @if ($avatar)

                                <img src="{{ $avatar }}" class="h-full w-full">

                            @else 

                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">

                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />

                                </svg>

                            @endif

                        </span>

                        <div class="relative">

                            <button type="button" class="relative ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                
                                Change

                                <input type="file" wire:model="avatar_file" class="absolute left-0 top-0 w-full h-full opacity-0"/>

                            </button>

                        </div>

                    </div>

                </div>
                
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                <div class="sm:col-span-3">

                    <label for="first-name" class="block text-sm font-medium text-gray-700"> First name </label>

                    <div class="mt-1">

                        <input wire:model="edit_user.first_name" type="text" name="first-name" id="first-name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_user.first_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-3">
                
                    <label for="last-name" class="block text-sm font-medium text-gray-700"> Last name </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.last_name" type="text" name="last-name" id="last-name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_user.last_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-4">

                    <label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>

                    <div class="mt-1">

                        <input wire:model="edit_user.email" id="email" name="email" type="email" autocomplete="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

                    </div>

                    @error('edit_user.email') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                </div>

                <div class="sm:col-span-2">

                    <label for="account_type" class="block text-sm font-medium text-gray-700"> Account Type </label>

                    <div class="mt-1">

                        <select @if (auth()->user()->id == $edit_user->id) disabled @endif wire:model="edit_user.account_type" id="account_type" name="account_type" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @if (auth()->user()->id == $edit_user->id) bg-gray-200 @endif">

                            <option value="">-- Choose Type --</option>

                            <option value="admin">Admin</option>

                            <option value="learner">Learner</option>

                            <option value="employer">Employer</option>

                            <option value="trainer">Trainer</option>

                        </select>

                        @error('edit_user.account_type') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror

                    </div>

                </div>

                @if ($edit_user->account_type == 'learner')

                <div class="sm:col-span-2">
                
                    <label for="account_type" class="block text-sm font-medium text-gray-700"> Trainer </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_user.trainer_id" id="trainer" name="trainer" autocomplete="trainer_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @if (auth()->user()->id == $edit_user->id) bg-gray-200 @endif">
                
                            <option value="">-- Choose Trainer --</option>
                            
                            @foreach (App\Models\User::where('account_type', '=', 'trainer')->select('id', 'first_name', 'last_name')->get() as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->getFullName() }}</option>
                            @endforeach
                
                        </select>
                
                        @error('edit_user.trainer_id') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                    </div>
                
                </div>

                @endif

                <div class="sm:col-span-3">

                    <label for="password" class="block text-sm font-medium text-gray-700"> Password (Leave blank to skip)</label>

                    <div class="mt-1">

                        <input wire:model="password" type="text" name="password" id="password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        
                    </div>

                </div>


                @if ($edit_user->account_type == 'learner')
                
                <div class="sm:col-span-3">
                
                    <label for="learner_phone_number" class="block text-sm font-medium text-gray-700"> Phone Number </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.phone_number" type="tel" name="learner_phone_number" id="learner_phone_number" autocomplete="phone_number" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_user.phone_number') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="work_place" class="block text-sm font-medium text-gray-700"> Work Place </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.work_place" type="text" name="work_place" id="work_place" autocomplete="work_place" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('work_place') }}">
                
                    </div>
                
                    @error('edit_user.work_place') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="manager_name" class="block text-sm font-medium text-gray-700"> Manager Name </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.manager_name" type="text" name="manager_name" id="manager_name" autocomplete="manager_name" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('manager_name') }}">
                
                    </div>
                
                    @error('edit_user.manager_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="reflection_activity_date" class="block text-sm font-medium text-gray-700"> Reflection Activity Date </label>
                
                    <div class="mt-1">
                
                        <input onchange="@this.set('edit_user.reflection_activity_date', this.value)" value="{{ $edit_user->reflection_activity_date ? $edit_user->reflection_activity_date->format('Y-m-d') : '' }}" type="date" name="reflection_activity_date" id="reflection_activity_date" autocomplete="reflection_activity_date" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('reflection_activity_date') }}">
                
                    </div>
                
                    <small>Enter date for prompting reflection activity.</small>
                
                    @error('edit_user.reflection_activity_date') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="reflection_activity_postcode" class="block text-sm font-medium text-gray-700"> Reflection Activity Postcode </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.reflection_activity_postcode" type="text" name="reflection_activity_postcode" id="reflection_activity_postcode" autocomplete="reflection_activity_postcode" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('reflection_activity_postcode') }}">
                
                    </div>
                
                    <small>Enter date for prompting reflection activity.</small>
                
                    @error('edit_user.reflection_activity_postcode') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                @elseif ($edit_user->account_type == 'trainer')
                
                <div class="sm:col-span-3">
                
                    <label for="course" class="block text-sm font-medium text-gray-700"> Course/Cohort </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_user.course" name="course" id="course" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose Course/Cohort --</option>
                            @foreach (getCoursePreferences() as $preference)
                            <option value="{{ $preference['value'] }}">{{ $preference['name'] }}</option>
                            @endforeach
                        </select>
                
                    </div>
                
                    @error('edit_user.course') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                @elseif ($edit_user->account_type == 'employer')
                
                <div class="sm:col-span-3">
                
                    <label for="company_name" class="block text-sm font-medium text-gray-700"> Company Name </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.company_name" type="text" name="company_name" id="company_name" autocomplete="company_name" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_user.company_name') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="service_type" class="block text-sm font-medium text-gray-700"> Service Type </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.service_type" type="text" name="service_type" id="service_type" autocomplete="service_type" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_user.service_type') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="employer_phone_number" class="block text-sm font-medium text-gray-700"> Employer Main Contact Number </label>
                
                    <div class="mt-1">
                
                        <input wire:model="edit_user.phone_number" type="text" name="employer_phone_number" id="employer_phone_number" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                    </div>
                
                    @error('edit_user.phone_number') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                <div class="sm:col-span-3">
                
                    <label for="reporting_preference" class="block text-sm font-medium text-gray-700"> Reporting Preference </label>
                
                    <div class="mt-1">
                
                        <select wire:model="edit_user.reporting_preference" name="reporting_preference" id="reporting_preference" class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md">
                
                            <option value="">-- Choose --</option>
                            @foreach (getReportingPreferences() as $preference)
                            <option value="{{ $preference['value'] }}">{{ $preference['name'] }}</option>
                            @endforeach
                        </select>
                
                    </div>
                
                    @error('edit_user.reporting_preference') <div class="bg-red-500 py-2 px-4 text-white rounded mt-1">{{ $message }}</div> @enderror
                
                </div>
                
                @endif

            </div>

        </div>

    </div>

    <div class="pt-5">

        <div class="flex justify-end">

            <a href="{{ route('admin.users') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>

            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>

        </div>

    </div>

</form>
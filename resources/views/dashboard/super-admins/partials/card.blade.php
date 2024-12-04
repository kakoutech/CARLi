<div class="bg-white rounded-lg shadow w-full">

    <div class="p-5">

        <div><img src="{{ $user->getAvatar() }}" class="max-w-full mx-auto object-cover" /></div>

        <div class="border-b mb-5 mt-10">

            <div class="text-lg font-bold text-gray-900 truncate">{{ $user->getFullName() }}</div>

        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Email</div>
        
            <div>
        
                {{ $user->email }}

            </div>
        
        </div>
        
        <div class="border-b mb-5">

            <div class="block text-sm font-medium text-gray-700">Telephone Number</div>

            <div>

                {{ $user->telephone_number }}

            </div>

        </div>

        <div class="border-b mb-5">

            <div class="block text-sm font-medium text-gray-700"># Learners</div>

            <div>

                {{ $user->getLearnerCount() }}

            </div>

        </div>

        <div class="border-b mb-5">

            <div class="block text-sm font-medium text-gray-700">Status:</div>

            @if ($user->isActive())

                <div>
                    <p class="text-sm font-medium text-green-500 truncate">Active</p>
                </div>

            @else

                <div>
                    <p class="text-sm font-medium text-red-500 truncate">Draft</p>
                </div>

            @endif

        </div>

        <div class="">

            <div class="block text-sm font-medium text-gray-700">Actions:</div>

            <div>

                <a href="{{ route('dashboard.super-admins.edit', [$user->id]) }}" class="cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Edit </a>
                
                <a onclick="if(confirm('Are you sure you want to delete this super admin?')) document.getElementById('delete_user_{{ $user->id }}').submit()" class="ml-2 cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Delete </a>
                
                <form id="delete_user_{{ $user->id }}" method="POST" action="{{ route('dashboard.super-admins.delete', [$user->id]) }}" class="inline">
                    @csrf
                    @method('delete')
                </form>

            </div>

        </div>

    </div>

</div>
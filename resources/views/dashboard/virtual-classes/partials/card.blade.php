<div class="bg-white rounded-lg shadow w-full">

    <div class="p-5">

        <div><img src="{{ $class->getThumbnail() }}" class="max-w-full mx-auto object-cover" /></div>

        <div class="border-b mb-5 mt-10">

            <div class="text-lg font-bold text-gray-900 truncate">{{ $class->getTitle() }}</div>

        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Category</div>
        
            <div>
        
                {{ $class->category ? $class->category->getName() : '-' }}
        
            </div>
        
        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Language</div>
        
            <div>
        
                {{ $class->language ? $class->language->getName() : '-' }}
        
            </div>
        
        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Trainer</div>
        
            <div>
        
                @if ($class->trainer)
        
                <a title="View Trainer" class="text-brand-500 font-bold" href="{{ route('dashboard.trainers.view', $class->trainer_id) }}">{{ $class->trainer->getFullName() }}</a>
        
                @else
        
                (no trainer)
        
                @endif
        
            </div>
        
        </div>
        
        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Class Type</div>
        
            <div>
        
                @if ($class->isSingle()) Single @endif
                @if ($class->isRecurring()) Recurring @endif
        
            </div>
        
        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Date/Time</div>
        
            <div>
        
                @if ($class->isSingle()) 

                    {{ $class->start_date ? $class->start_date->format('d/m/Y') : '-' }}

                    {{ $class->start_time }}

                @endif

                @if ($class->isRecurring()) 
                
                    Recurring {{ ucwords($class->recurrence) }} From {{ $class->start_date ? $class->start_date->format('d/m/Y') : '-' }}
                    
                    {{ $class->start_time }}
                    
                @endif
        
            </div>
        
        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Duration</div>
        
            <div>
        
                {{ $class->getDuration() }} Minutes  

            </div>
        
        </div>

        <div class="border-b mb-5">

            <div class="block text-sm font-medium text-gray-700">Host</div>

            <div>

                @if ($class->host) 

                    <a href="{{ $class->host }}" target="_blank">{{ $class->host }}</a>

                @else 

                    (no host set)

                @endif

            </div>

        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Trainer Password</div>
        
            <div>
        
                {{ $class->trainer_password ?: '(none set)' }}
        
            </div>
        
        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Learner Password</div>
        
            <div>
        
                {{ $class->learner_password ?: '(none set)' }}
        
            </div>
        
        </div>

        <div class="border-b mb-5">
        
            <div class="block text-sm font-medium text-gray-700">Attendees</div>
        
            <div>
                
                {{ $class->getAttendeeCount() }}
        
            </div>
        
        </div>

        <div class="border-b mb-5">

            <div class="block text-sm font-medium text-gray-700">Status:</div>

            @if ($class->isActive())

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

                <a href="{{ route('dashboard.virtual-classes.edit', [$class->id]) }}" class="cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Edit </a>
                
                <a onclick="if(confirm('Are you sure you want to delete this virtual class?')) document.getElementById('delete_course_{{ $class->id }}').submit()" href="#" class="ml-2 cursor-pointer items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"> Delete </a>
                
                <form id="delete_course_{{ $class->id }}" method="POST" action="{{ route('dashboard.virtual-classes.delete', [$class->id]) }}" class="inline">
                
                    @csrf
                
                    @method('delete')
                
                </form>

            </div>

        </div>

    </div>

</div>
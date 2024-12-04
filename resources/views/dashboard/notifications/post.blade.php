
            </div>

            @if (isset($hide_dismiss) && $hide_dismiss)

            @else 

                <div tabindex="0" aria-label="close icon" role="button" class="focus:outline-none cursor-pointer">

                    @livewire('notifications.dismiss', [$notification->id])

                </div>

            @endif

        </div>
        
        <div tabindex="0" class="focus:outline-none text-sm leading-3 pt-1 text-gray-500">

            {{ $notification->created_at->diffForHumans() }}

        </div>

    </div>

</div>
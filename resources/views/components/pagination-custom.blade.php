<div>
    {{-- @if ($paginator->hasPage()) --}}
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between gap-2">
        <span>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {{ trans('msg.previous') }}
                </span> --}}
                <span type="button" wire:click="previousPage"
                    class="bg-green-800 text-white rounded-l-md border-r border-green-100 py-2 px-3">
                    <div class="flex flex-row align-middle">
                        <svg class="w-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="ml-2">{{ trans('msg.previous') }}</p>
                    </div>
                </span>
            @else
                {{-- <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {{ trans('msg.previous') }}
                </button> --}}
                <button type="button" wire:click="previousPage"
                    class="bg-green-800 text-white rounded-l-md border-r border-green-100 py-2 hover:bg-green-700 hover:text-white px-3">
                    <div class="flex flex-row align-middle">
                        <svg class="w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="ml-2">{{ trans('msg.previous') }}</p>
                    </div>
                </button>
            @endif
        </span>

        <span>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {{ trans('msg.next') }}
                </button> --}}
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                    class="bg-green-800 text-white rounded-r-md py-2 border-l border-green-200 hover:bg-green-700 hover:text-white px-3">
                    <div class="flex flex-row align-middle">
                        <span class="mr-2">{{ trans('msg.next') }}</span>
                        <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </button>
            @else
                {{-- <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {{ trans('msg.next') }}
                </span> --}}
                <span type="button" wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                    class="bg-green-800 text-white rounded-r-md py-2 border-l border-green-200 px-3">
                    <div class="flex flex-row align-middle">
                        <span class="mr-2">{{ trans('msg.next') }}</span>
                        <svg class="w-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </span>
            @endif
        </span>
    </nav>
    {{-- @endif --}}
</div>

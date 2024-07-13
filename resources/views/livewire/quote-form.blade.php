<div class="isolate bg-white px-2 py-10 sm:py-10 lg:px-2">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]"
        aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
    </div>
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">TIQS</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">Travel Insurance Quote Calculator</p>
    </div>
    <form wire:submit.prevent="calculateQuote" class="mx-auto mt-16 max-w-xl sm:mt-20">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="destination" class="block text-sm font-semibold leading-6 text-gray-900">Choose a
                    Destination</label>
                <div class="mt-2.5">
                    <select name="destination" id="destination" wire:model="destination"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Choose a Destination</option>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination }}">
                                {{ ucwords(strpos($destination, '_') ? str_replace('_', ' ', $destination) : $destination) }}
                            </option>
                        @endforeach
                    </select>
                    @error('destination')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="start_date" class="block text-sm font-semibold leading-6 text-gray-900">Start Date</label>
                <div class="mt-2.5">
                    <input type="date" name="start_date" id="start_date" wire:model="start_date"
                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('start_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="end_date" class="block text-sm font-semibold leading-6 text-gray-900">End Date</label>
                <div class="mt-2.5">
                    <input type="date" name="end_date" id="end_date" wire:model="end_date"
                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('end_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="sm:col-span-2">
                <div class="mt-2.5 flex items-center gap-4">
                    @foreach ($coverage_options as $coverage_option)
                        <input type="checkbox" name="{{ $coverage_option }}" id="{{ $coverage_option }}"
                            wire:model="{{ $coverage_option }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="{{ $coverage_option }}"
                            class="ms-2 text-sm font-semibold leading-6 text-gray-900">{{ ucwords(strpos($coverage_option, '_') ? str_replace('_', ' ', $coverage_option) : $coverage_option) }}</label>
                    @endforeach
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="number_of_travelers" class="block text-sm font-semibold leading-6 text-gray-900">Number of
                    Travelers</label>
                <div class="mt-2.5">
                    <input type="number" name="number_of_travelers" id="number_of_travelers"
                        wire:model="number_of_travelers"
                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @error('number_of_travelers')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-10">
            <button type="submit"
                class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Calculate
                Quote</button>
        </div>
        @if ($quote_price)
            <div class="mx-auto max-w-2xl mt-10">
                <p class="text-lg font-bold tracking-tight text-gray-900">Quote Price:
                    ${{ number_format($quote_price, 2) }}</p>
            </div>
        @endif
    </form>
</div>

@if($items AND !$current_sum)
        <button onclick="location.href='{{ route('cart.clear') }}'"
                class="focus:outline-none bg-red-600 hover:bg-red-800 uppercase text-2xl text-white font-bold p-3 items-center">
                {{ trans($text) }}
        </button>
@else
        <button class="focus:outline-none cursor-not-allowed opacity-50 bg-red-600 text-2xl text-white uppercase font-bold p-3">
                {{ trans($text)  }}
        </button>
@endif
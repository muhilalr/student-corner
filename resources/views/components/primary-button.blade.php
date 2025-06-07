<button
  {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex w-full justify-center items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#00295A] focus:bg-[#00295A] active:bg-[#00295A] focus:outline-none focus:ring-2 focus:ring-[#00295A] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
  {{ $slot }}
</button>

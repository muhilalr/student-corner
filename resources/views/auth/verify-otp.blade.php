<x-guest-layout>

  <h1 class="text-2xl text-center font-bold mb-4">Verifikasi Email</h1>
  <p class="mb-4 text-center">Masukkan kode OTP yang dikirim ke <strong>{{ $email }}</strong></p>

  <p class="text-red-600 text-center font-semibold mb-4">
    <span id="otp-timer"></span>
  </p>

  <form method="POST" action="{{ route('verification.otp.submit') }}" id="otp-form">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="otp" id="otp" />

    <div class="flex justify-center space-x-2 mb-4">
      @for ($i = 0; $i < 6; $i++)
        <input type="text" maxlength="1"
          class="otp-input w-12 h-12 text-center text-xl border rounded-md focus:ring-2 focus:ring-blue-500"
          inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" />
      @endfor
    </div>

    <x-input-error :messages="$errors->get('otp')" class="mt-2 text-center" />

    <div class="mt-4 text-center">
      <x-primary-button>Verifikasi</x-primary-button>
    </div>
  </form>


  {{-- Tombol kirim ulang --}}
  <form method="POST" action="{{ route('verification.otp.resend') }}" class="mt-3 text-center">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <button type="submit" class="text-primary hover:underline">
      Kirim ulang kode OTP
    </button>
  </form>

  <script>
    // Ambil waktu expired dari server (format ISO)
    const expiredAt = new Date("{{ $expired_at }}").getTime();

    function updateTimer() {
      const now = new Date().getTime();
      const distance = expiredAt - now;

      if (distance <= 0) {
        document.getElementById("otp-timer").innerHTML = "Kadaluarsa!";
        return;
      }

      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById("otp-timer").innerHTML =
        minutes + ":" + seconds;
    }

    // Update setiap detik
    updateTimer();
    setInterval(updateTimer, 1000);







    const inputs = document.querySelectorAll(".otp-input");
    const hiddenOtp = document.getElementById("otp");
    const form = document.getElementById("otp-form");

    inputs.forEach((input, index) => {
      input.addEventListener("input", (e) => {
        if (e.target.value.length > 0 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
        updateHiddenOtp();
      });

      input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });

    function updateHiddenOtp() {
      hiddenOtp.value = Array.from(inputs).map(i => i.value).join("");
    }

    form.addEventListener("submit", (e) => {
      updateHiddenOtp();
      if (hiddenOtp.value.length < 6) {
        e.preventDefault();
        alert("Kode OTP harus 6 digit.");
      }
    });
  </script>
</x-guest-layout>

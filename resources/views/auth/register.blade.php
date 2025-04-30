<style>
.auth-card {
    width: 400px;
    background: white;
    padding: 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin: 5rem auto;
    text-align: center;
}
.auth-header h1 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #4f46e5;
}
.auth-header p {
    margin-top: 0.5rem;
    font-size: 1rem;
    color: #6b7280;
}
</style>

<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <h1>Create an Account</h1>
            <p>Join Pifacia Garment Management</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" value="Full Name" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" value="Email Address" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-6">
                <x-primary-button class="w-full justify-center">
                    Register
                </x-primary-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Sign in</a>
            </p>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:underline">← Back to Home</a>
        </div>
    </div>
</x-guest-layout>

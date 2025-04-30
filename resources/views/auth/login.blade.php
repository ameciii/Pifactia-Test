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
            <h1>Pifacia Garment Management</h1>
            <p>Sign in to access your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" value="Email Address" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 flex justify-between items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            </div>

            <div class="flex items-center justify-center mt-6">
                <x-primary-button class="w-full justify-center">
                    Sign In
                </x-primary-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Create an account</a>
            </p>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:underline">← Back to Home</a>
        </div>
    </div>
</x-guest-layout>

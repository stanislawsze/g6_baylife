<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <div class="grid grid-cols-2 gap-8">
        @if (Auth::user()->global_name)
            <div>
                <x-input-label for="global_name" :value="__('Display Name')" />
                <x-text-input  id="global_name" name="global_name" type="text" class="mt-1 block w-full" :value="old('global_name', $user->global_name)" required autocomplete="global_name" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('global_name')" />
            </div>
        @endif
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input  id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" disabled />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        @if (!Auth::user()->global_name)
            <div>
                <x-input-label for="discriminator" :value="__('Discriminator')" />
                <x-text-input id="discriminator" name="discriminator" type="text" class="mt-1 block w-full" :value="old('discriminator', $user->discriminator)" required autocomplete="discriminator" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('discriminator')" />
            </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email ?? __('Unknown'))" required autocomplete="email" disabled />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->verified)
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                    </p>
                </div>
            @endif
        </div>
        <div>
            <x-input-label for="phone" :value="__('Numéro de téléphone')" />
            <x-text-input id="phone" name="phone" type="text" :value="old('phone', $user->employee->phone ?? __('Unknown'))" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
            <div>
                <x-input-label for="birthday" :value="__('Date de naissance')" />
                <x-text-input id="birthday" name="birthday" type="date" :value="old('birthday', $user->employee->birthday ?? __('Unknown'))" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
            </div>
            <div>
                <x-input-label for="origines" :value="__('Origines')" />
                <x-text-input id="origines" name="origines" type="text" :value="old('origines', $user->employee->origines ?? __('Arabe'))" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('origines')" />
            </div>
            <div>
                <x-input-label for="pistol_sn" :value="__('Numéro de série 9mm')" />
                <x-text-input id="pistol_sn" name="pistol_sn" type="text" :value="old('pistol_sn', $user->employee->pistol_sn ?? __('Unknown'))" class="mt-1 block w-full" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('pistol_sn')" />
            </div>
            <div>
                <x-input-label for="shotgun_sn" :value="__('Numéro de série fusil à pompe')" />
                <x-text-input id="shotgun_sn" name="shotgun_sn" type="text" :value="old('shotgun_sn', $user->employee->shotgun_sn ?? __('Unknown'))" class="mt-1 block w-full" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('shotgun_sn')" />
            </div>
            <div>
                <x-input-label for="torch_sn" :value="__('Numéro de série lampe torche')" />
                <x-text-input id="torch_sn" name="torch_sn" type="text" :value="old('torch_sn', $user->employee->torch_sn ?? __('Unknown'))" class="mt-1 block w-full" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('torch_sn')" />
            </div>
            <div>
                <x-input-label for="baton_sn" :value="__('Numéro de série matraque')" />
                <x-text-input id="baton_sn" name="baton_sn" type="text" :value="old('baton_sn', $user->employee->baton_sn ?? __('Unknown'))" class="mt-1 block w-full" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('baton_sn')" />
            </div>
            <div>
                <x-input-label for="tazer_sn" :value="__('Numéro de série tazer')" />
                <x-text-input id="tazer_sn" name="tazer_sn" type="text" :value="old('tazer_sn', $user->employee->tazer_sn ?? __('Unknown'))" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('tazer_sn')" />
            </div>
    </div>
</section>

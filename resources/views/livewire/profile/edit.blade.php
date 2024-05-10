<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <div class="grid grid-cols-3 gap-8">
        @if (Auth::user()->global_name)
            <div>
                <x-input-label for="global_name" :value="__('Display Name')" />
                <x-text-input  id="global_name" name="global_name" type="text" class="mt-1 block w-full" :value="old('global_name', $user->global_name)" required autocomplete="global_name" disabled />
                <x-input-error class="mt-2" :messages="$errors->get('global_name')" />
            </div>
        @endif
        <div>
            <x-input-label for="phone" :value="__('Numéro de téléphone')" />
            <x-text-input id="phone" wire:model.blur="profile.phone" class="mt-1 block w-full" placeholder="0123456" />
            <x-input-error class="mt-2" :messages="$errors->get('profile.phone')" />
        </div>
        <div>
            <x-input-label for="birthday" :value="__('Date de naissance')" />
            <x-text-input id="birthday" type="date" wire:model.blur="profile.birthday" class="mt-1 block w-full" placeholder="2024-05-10" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>
        <div>
            <x-input-label for="origines" :value="__('Origines')" />
            <x-text-input id="origines" wire:model.blur="profile.origines" class="mt-1 block w-full" placeholder="ARABE" />
            <x-input-error class="mt-2" :messages="$errors->get('origines')" />
        </div>
        <div>
            <x-input-label for="pistol_sn" :value="__('Numéro de série 9mm')" />
            @cannot('manage', \App\Models\DiscordRole::class)
                <x-text-input id="pistol_sn" wire:model.blur="profile.pistolSN" class="mt-1 block w-full" disabled placeholder="ALLAH AKBAR" />
            @else
                <x-text-input id="pistol_sn" wire:model.blur="profile.pistolSN" class="mt-1 block w-full" placeholder="ALLAH AKBAR" />
            @endcannot
            <x-input-error class="mt-2" :messages="$errors->get('pistol_sn')" />
        </div>
        <div>
            <x-input-label for="shotgun_sn" :value="__('Numéro de série fusil à pompe')" />
            @cannot('manage', \App\Models\DiscordRole::class)
                <x-text-input id="shotgun_sn" wire:model.blur="profile.shotgunSN" class="mt-1 block w-full" disabled placeholder="ALLAH AKBAR" />
            @else
                <x-text-input id="shotgun_sn" wire:model.blur="profile.shotgunSN" class="mt-1 block w-full" placeholder="ALLAH AKBAR" />
            @endcannot
            <x-input-error class="mt-2" :messages="$errors->get('shotgun_sn')" />
        </div>
        <div>
            <x-input-label for="torch_sn" :value="__('Numéro de série lampe torche')" />
            @cannot('manage', \App\Models\DiscordRole::class)
                <x-text-input id="torch_sn" wire:model.blur="profile.torchSN" class="mt-1 block w-full" disabled placeholder="ALLAH AKBAR" />
            @else
                <x-text-input id="torch_sn" wire:model.blur="profile.torchSN" class="mt-1 block w-full" placeholder="ALLAH AKBAR" />
            @endcannot
            <x-input-error class="mt-2" :messages="$errors->get('torch_sn')" />
        </div>
        <div>
            <x-input-label for="baton_sn" :value="__('Numéro de série matraque')" />
            @cannot('manage', \App\Models\DiscordRole::class)
                <x-text-input id="baton_sn" wire:model.blur="profile.batonSN" class="mt-1 block w-full" disabled placeholder="ALLAH AKBAR" />
            @else
                <x-text-input id="baton_sn" wire:model.blur="profile.batonSN" class="mt-1 block w-full" placeholder="ALLAH AKBAR" />
            @endcannot
            <x-input-error class="mt-2" :messages="$errors->get('baton_sn')" />
        </div>
        <div>
            <x-input-label for="tazer_sn" :value="__('Numéro de série tazer')" />
            @cannot('manage', \App\Models\DiscordRole::class)
                <x-text-input id="tazer_sn" wire:model.blur="profile.tazerSN" class="mt-1 block w-full" disabled placeholder="ALLAH AKBAR" />
            @else
                <x-text-input id="tazer_sn" wire:model.blur="profile.tazerSN" class="mt-1 block w-full" placeholder="ALLAH AKBAR" />
            @endcannot
            <x-input-error class="mt-2" :messages="$errors->get('tazer_sn')" />
        </div>
    </div>
</section>


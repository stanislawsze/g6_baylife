<div>
    {{$discordRole->role_name}}
    <table class="table-auto w-full">
        <thead class="bg-white dark:bg-gray-800 border-b">
        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
            Nom de la permission
        </th>
        <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">

        </th>
        </thead>
        <tbody>
            <tr>
                <td>Créer des convois</td>
                <td>
                    <x-text-input type="checkbox"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Ajouter des fiches agents</td>
                <td>
                    <x-text-input type="checkbox"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Gérer les primes</td>
                <td>
                    <x-text-input type="checkbox"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Gérer les rôles</td>
                <td>
                    <x-text-input type="checkbox"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Gérer les webhooks</td>
                <td>
                    <x-text-input type="checkbox"></x-text-input>
                </td>
            </tr>
        </tbody>
    </table>
    <x-secondary-button wire:click="save">Sauvegarder</x-secondary-button>
</div>

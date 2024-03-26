<div>
    {{$discordRole->role_name}}
    <form>
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
                    <x-text-input type="checkbox" wire:model="permission.isConvoyManager"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Créer des convois ATM</td>
                <td>
                    <x-text-input type="checkbox" wire:model="permission.isAtmManager"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Ajouter des fiches agents</td>
                <td>
                    <x-text-input type="checkbox" wire:model="permission.isTeamManager"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Gérer les primes</td>
                <td>
                    <x-text-input type="checkbox" wire:model="permission.isSalaryManager"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Gérer les rôles</td>
                <td>
                    <x-text-input type="checkbox" wire:model="permission.isRoleManager"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Gérer les webhooks</td>
                <td>
                    <x-text-input type="checkbox" wire:model="permission.isWebhookManager"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Salaire en patrouille</td>
                <td>
                    <x-text-input type="number" wire:model="permission.salaryPatrol" placeholder="0"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Salaire en mission</td>
                <td>
                    <x-text-input type="number" wire:model="permission.salaryMission" placeholder="0"></x-text-input>
                </td>
            </tr>
            <tr>
                <td>Salaire Bonus</td>
                <td>
                    <x-text-input type="number" wire:model="permission.salaryBonus" placeholder="0"></x-text-input>
                </td>
            </tr>
            </tbody>
        </table>
        <x-secondary-button wire:click="save" class="my-4">Sauvegarder</x-secondary-button>
    </form>
</div>

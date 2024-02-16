<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Convois') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full">
                        <thead class="bg-white dark:bg-gray-800 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                                Date du convoi
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                                Statut du convoi
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                                Nombre d'agent
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 dark:text-gray-200 px-6 py-4 text-left">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($convoys as $c)
                            <tr class="bg-white dark:bg-gray-800 border-b transition duration-300 ease-in-out">
                                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                    {{date('d/m/Y h:i', strtotime($c->start_at))}}
                                </td>
                                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                    @if($c->is_finished)
                                        Terminé
                                    @else
                                        {{$c->is_started ? 'En cours' : 'Non débuté'}}
                                    @endif
                                </td>
                                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                    {{$c->users->count()}}
                                </td>
                                <td class="text-sm text-gray-900 dark:text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('convoy.show', ['convoy' => $c])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

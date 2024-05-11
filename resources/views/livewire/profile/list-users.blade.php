<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{$users->count()}} Agents recensés
        </h2>
    </header>

    <div class="my-5 bg-gray-800 text-gray-200 rounded-3xl p-5">
        <hr />
        <table class="min-w-full">
            <thead class="bg-gray-800 border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Nom de l'agent
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Grade
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Avertissement(s)
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Prime en cours
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $u)
                <tr class="bg-gray-800 border-b transition duration-300 ease-in-out">
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$u->global_name}}
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$u->getRole->roles->role_name}}
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        @switch($u->warnings->count())
                            @case(0)
                                <span class="font-bold text-green-500">0</span>
                            @break
                            @case(1)
                                <span class="font-bold text-yellow-500">1</span>
                                @break
                            @case(2)
                                <span class="font-bold text-orange-500">2</span>
                                @break
                            @case(3)
                                <span class="font-bold text-red-500">3</span>
                                @break
                        @endswitch
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{number_format($u->convoySalaries()+$u->dutySalary(), 2, ',', ' ')}} $
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap flex gap-4">
                        <a class="text-blue-500" href="{{route('profile.edit', ['id' => $u->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        <a class="text-blue-500" href="{{route('profile.edit', ['id' => $u->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>


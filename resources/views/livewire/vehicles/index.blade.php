<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{$vehicles->count()}} Véhicules enregistrés
        </h2>
    </header>

    <div class="my-5 bg-gray-800 text-gray-200 rounded-3xl p-5">
        <hr />
        <table class="min-w-full">
            <thead class="bg-gray-800 border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Nom de ta mère
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Plaque
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Image
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left">
                    Informations
                </th>
                <th scope="col" class="text-sm font-medium text-gray-200 px-6 py-4 text-left"> Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $v)
                <tr class="bg-gray-800 border-b transition duration-300 ease-in-out">
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$v->name}}
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        {{$v->plate}}
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        <img src="{{asset($v->image)}}" class="w-10 h-10" />
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{$v->in_use ? 'text-red-500' : 'text-green-500'}}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{$v->is_refuel ? 'text-green-500' : 'text-red-500'}}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 10.5h.375c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125H21M4.5 10.5H18V15H4.5v-4.5ZM3.75 18h15A2.25 2.25 0 0 0 21 15.75v-6a2.25 2.25 0 0 0-2.25-2.25h-15A2.25 2.25 0 0 0 1.5 9.75v6A2.25 2.25 0 0 0 3.75 18Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{$v->is_maintained ? 'text-green-500' : 'text-red-500'}}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  {{$v->is_usable_for_convoy ? 'text-green-500' : 'text-red-500'}}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                    </td>
                    <td class="text-sm text-gray-200 font-light px-6 py-4 whitespace-nowrap flex gap-4">
                        <a class="text-blue-500" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        {{--<a class="text-blue-500" href="{{route('profile.edit', ['id' => $u->id])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>


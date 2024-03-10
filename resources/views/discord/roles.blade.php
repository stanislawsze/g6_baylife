<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach($roles as $r)
                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium text-black border bg-white"><span class="border border-1 p-1 rounded-full mr-2"  style="background: #{{dechex($r->role_color)}}"></span>{{$r->role_name}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

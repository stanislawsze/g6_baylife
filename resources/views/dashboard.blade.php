<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="card">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="38px" width="38px" version="1.1" id="heart" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xml:space="preserve">
                                    <linearGradient id="gradientColor">
                                        <stop offset="5%" stop-color="#67b500"></stop>
                                        <stop offset="95%" stop-color="#1A3300"></stop>
                                    </linearGradient>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="title">Salaire en patrouille</p>
                            <p class="text">{{ number_format(auth()->user()->dutyPatrolSalary(), 2, ',', ' ')}} $</p>
                        </div>
                        <div class="card">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="38px" width="38px" version="1.1" id="heart" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xml:space="preserve">
                                    <linearGradient id="gradientColor">
                                        <stop offset="5%" stop-color="#67b500"></stop>
                                        <stop offset="95%" stop-color="#1A3300"></stop>
                                    </linearGradient>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="title">Salaire en service</p>
                            <p class="text">{{ number_format(auth()->user()->dutySalary(), 2, ',', ' ')}} $</p>
                        </div>
                        <div class="card">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="38px" width="38px" version="1.1" id="heart" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xml:space="preserve">
                                    <linearGradient id="gradientColor">
                                        <stop offset="5%" stop-color="#67b500"></stop>
                                        <stop offset="95%" stop-color="#1A3300"></stop>
                                    </linearGradient>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="title">Salaire en Convoi</p>
                            <p class="text">{{number_format(auth()->user()->convoySalaries(), 2, ',', ' ')}} $</p>
                        </div>
                        <div class="card">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="38px" width="38px" version="1.1" id="heart" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xml:space="preserve">
                                    <linearGradient id="gradientColor">
                                        <stop offset="5%" stop-color="#67b500"></stop>
                                        <stop offset="95%" stop-color="#1A3300"></stop>
                                    </linearGradient>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="title">Salaire total</p>
                            <p class="text">{{number_format(auth()->user()->convoySalaries()+auth()->user()->dutySalary(), 2, ',', ' ')}} $</p>
                        </div>
                        <div class="card">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="38px" width="38px" version="1.1" id="heart" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xml:space="preserve">
                                    <linearGradient id="gradientColor">
                                        <stop offset="5%" stop-color="#67b500"></stop>
                                        <stop offset="95%" stop-color="#1A3300"></stop>
                                    </linearGradient>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="title">Temps de patrouille</p>
                            <p class="text">{{$time_on_duty['patrol']}}</p>
                        </div>
                        <div class="card">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="38px" width="38px" version="1.1" id="heart" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xml:space="preserve">
                                    <linearGradient id="gradientColor">
                                        <stop offset="5%" stop-color="#67b500"></stop>
                                        <stop offset="95%" stop-color="#1A3300"></stop>
                                    </linearGradient>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="title">Temps de Mission Sécurité</p>
                            <p class="text">{{$time_on_duty['security']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Геолокация
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Подробная информация о местоположении
            </p>
        </div>

        <!-- Основной контейнер с сеткой -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Населенный пункт -->
            <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-3xl shadow-2xl p-8 text-white transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-semibold uppercase tracking-wide opacity-90">Населенный пункт</div>
                </div>
                <div class="text-2xl font-bold mb-3 leading-tight">
                    {{$geo->locality['name']}}
                </div>
                <hr class="border-white/30 my-4">
                <p class="text-blue-100 leading-relaxed opacity-95 text-lg">
                    {{$geo->locality['description']}}
                </p>
            </div>

            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl shadow-2xl p-8 text-white transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"></path>
                            <path fill-rule="evenodd" d="M13.5 7.5a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM10 9.25a.75.75 0 01.75.75v4a.75.75 0 01-1.5 0v-4A.75.75 0 0110 9.25z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-semibold uppercase tracking-wide opacity-90">Ближайшее метро</div>
                </div>
                <div class="text-2xl font-bold mb-3 leading-tight">
                    {{$geo->metro['name']}}
                </div>
                <hr class="border-white/30 my-4">
                <p class="text-emerald-100 leading-relaxed opacity-95 text-lg">
                    {{$geo->metro['description']}}
                </p>
            </div>

            <!-- Ближайшая улица -->
            <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-3xl shadow-2xl p-8 text-white transform hover:-translate-y-2 transition-all duration-300 group lg:col-span-2">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 2.252a.75.75 0 01.434.96L8.5 7.5h5.5a.75.75 0 01.565 1.228l-4.334 6H15a.75.75 0 010 1.5H8.5l3.934-4.25A.75.75 0 0112 9.748V2.252z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-semibold uppercase tracking-wide opacity-90">Ближайшая улица</div>
                </div>
                <div class="text-3xl font-bold mb-3 leading-tight">
                    {{$geo->street['name']}}
                </div>
                <hr class="border-white/30 my-4">
                <p class="text-purple-100 leading-relaxed opacity-95 text-lg">
                    {{$geo->street['description']}}
                </p>
            </div>

            <!-- Ближайший дом -->
            <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-3xl shadow-2xl p-8 text-white transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-semibold uppercase tracking-wide opacity-90">Ближайший дом</div>
                </div>
                <div class="text-2xl font-bold mb-3 leading-tight">
                    {{$geo->house['name']}}
                </div>
                <hr class="border-white/30 my-4">
                <p class="text-orange-100 leading-relaxed opacity-95 text-lg">
                    {{$geo->house['description']}}
                </p>
            </div>
            <a href="{{route('geo.index')}}" class="inline-flex items-center gap-2 mb-12 lg:mb-16 px-6 py-3 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl hover:bg-white/20 hover:border-white/30 transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-2xl hover:shadow-orange-500/25 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-semibold text-sm uppercase tracking-wide">Назад ко всем местам</span>
            </a>
        </div>
    </div>
</div>
@endsection
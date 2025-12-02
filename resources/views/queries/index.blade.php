@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Заголовок и кнопка назад -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Запросы</h1>
                <p class="mt-1 text-gray-600">Всего запросов: {{ $queries->count() }}</p>
            </div>
            <a href="{{ route('geo.index') }}"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none">
                ← Назад </a>
        </div>

        <!-- Список запросов -->
        <div class="grid gap-4">
            @foreach ($queries as $query)
                <div class="rounded-lg border border-gray-200 bg-white p-4 transition-shadow hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="mb-2 text-gray-800">{{ $query->text }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $query->updated_at->format('d.m.Y в H:i') }}
                            </div>
                        </div>
                        <span class="ml-4 text-xs whitespace-nowrap text-gray-400">
                            {{ $query->updated_at->diffForHumans() }} </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

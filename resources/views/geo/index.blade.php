@extends('layouts.app')
@section('content')
    <div class="container mx-auto py-10 px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Поиск ближайших объектов по адресу</h1>
            <p class="text-gray-600 mt-2">Введите адрес, чтобы получить 5 ближайших станций метро, улиц, домов и информации о
                районе.</p>
        </div>




        <form action="{{ route('geo.store') }}" method="POST"
            class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl mx-auto mb-8">
            @csrf
            <div class="flex flex-col">
                <label for="address" class="mb-2 text-sm font-medium text-gray-700">Адрес</label>
                <input id="address" name="address" type="text" required
                    placeholder="Введите адрес, например: г. Москва, ул. Тверская, дом 1"
                    class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                    value="{{ old('address', isset($address) ? $address : '') }}">
                @error('address')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="md:col-span-2 flex justify-start items-end">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Найти близлежащие объекты
                </button>
            </div>
        </form>

        @if (isset($geos) && is_array($geos) && count($geos) > 0)
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-semibold mb-4">Геоместа из Яндекс.Geocoder</h1>
                @foreach ($geos as $geo)
                    <div class="grid grid-cols-12 items-center px-4 py-4 hover:bg-gray-50">
                        <div class="col-span-9">
                            <div class="text-gray-900 font-medium">{{ $geo->name ?? 'Название места отсутствует' }}</div>
                            <div class="text-gray-600 text-sm line-clamp-2 mt-1">
                                {{ $geo->description }}
                            </div>
                        </div>
                        <div class="col-span-3 flex justify-end">
                            <a href="{{ route('geo.show', $geo->pos) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors">
                                Подробнее
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

                <div>
            <div class="max-w-2xl mx-auto">
                <h1 class="text-2xl font-bold mb-6">Последние запросы</h1>
                <a href="{{route('queries.index')}}">Все запросы</a>
                @foreach ($queries as $query)
                    <div class="mb-4 p-4 border-l-4 border-blue-500 bg-gray-100">
                        <p class="text-gray-800">{{ $query->text }}</p>
                        <div class="text-sm text-gray-500 mt-2">
                            {{ $query->updated_at->format('H:i, d.m.Y') }}
                        </div>
                    </div>
                @endforeach

                @if (count($queries) === 0)
                    <p class="text-gray-500 text-center py-8">Нет запросов</p>
                @endif
            </div>
        </div>
    </div>
@endsection

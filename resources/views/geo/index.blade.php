@extends('layouts.app')
@section('content')
<div class="container mx-auto py-10 px-4">
    <!-- Заголовок -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Поиск ближайших объектов по адресу</h1>
        <p class="text-gray-600 mt-2">Введите адрес, чтобы получить 5 ближайших станций метро, улиц, домов и информации о районе.</p>
    </div>

    <!-- Форма ввода адреса -->
    <form action="{{route('geo.store')}}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl mx-auto mb-8">
        @csrf
        <div class="flex flex-col">
            <label for="address" class="mb-2 text-sm font-medium text-gray-700">Адрес</label>
            <input
                id="address"
                name="address"
                type="text"
                required
                placeholder="Введите адрес, например: г. Москва, ул. Тверская, дом 1"
                class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                value="{{ old('address', isset($address) ? $address : '') }}"
            >
            @error('address')
                <div>
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="md:col-span-2 flex justify-start items-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Найти близлежащие объекты
            </button>
        </div>
    </form>

    <!-- Результаты: выводятся в отдельных окнах/карточках -->
    @if(isset($results) && is_array($results) && count($results) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Метро -->
            <section class="bg-white rounded-xl shadow p-4 border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-gray-800">Метро (первые 5)</h2>
                    <span class="text-sm text-gray-500">по расстоянию</span>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach ($results['metro'] as $item)
                        <li class="py-3">
                            <div class="text-sm font-medium text-gray-800">{{ $item['name'] ?? '' }}</div>
                            @if(!empty($item['distance']))
                                <div class="text-xs text-gray-500">Расстояние: {{ $item['distance'] }} м</div>
                            @endif
                            @if(!empty($item['district']))
                                <div class="text-xs text-gray-500">Район: {{ $item['district'] }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Улицы -->
            <section class="bg-white rounded-xl shadow p-4 border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-gray-800">Улицы (первые 5)</h2>
                    <span class="text-sm text-gray-500">по расстоянию</span>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach ($results['streets'] as $item)
                        <li class="py-3">
                            <div class="text-sm font-medium text-gray-800">{{ $item['name'] ?? '' }}</div>
                            @if(!empty($item['distance']))
                                <div class="text-xs text-gray-500">Расстояние: {{ $item['distance'] }} м</div>
                            @endif
                            @if(!empty($item['district']))
                                <div class="text-xs text-gray-500">Район: {{ $item['district'] }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Дома -->
            <section class="bg-white rounded-xl shadow p-4 border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-gray-800">Дома (первые 5)</h2>
                    <span class="text-sm text-gray-500">по расстоянию</span>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach ($results['houses'] as $item)
                        <li class="py-3">
                            <div class="text-sm font-medium text-gray-800">{{ $item['address'] ?? '' }}</div>
                            @if(!empty($item['distance']))
                                <div class="text-xs text-gray-500">Расстояние: {{ $item['distance'] }} м</div>
                            @endif
                            @if(!empty($item['district']))
                                <div class="text-xs text-gray-500">Район: {{ $item['district'] }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Район города -->
            <section class="bg-white rounded-xl shadow p-4 border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-semibold text-gray-800">Район города (первые 5)</h2>
                    <span class="text-sm text-gray-500">по близости к адресу</span>
                </div>
                <ul class="divide-y divide-gray-200">
                    @foreach ($results['districts'] as $item)
                        <li class="py-3">
                            <div class="text-sm font-medium text-gray-800">{{ $item['name'] ?? '' }}</div>
                            @if(!empty($item['distance']))
                                <div class="text-xs text-gray-500">Расстояние: {{ $item['distance'] }} м</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    @elseif (isset($results) && is_array($results) && count($results) === 0)
        <div class="bg-white rounded-xl shadow p-6 text-center text-gray-700">
            Нет результатов. Попробуйте изменить адрес или увеличить точность ввода.
        </div>
    @endif
</div>
@endsection
  

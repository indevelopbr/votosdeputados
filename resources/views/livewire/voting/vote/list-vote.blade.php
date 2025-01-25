<div class="min-h-screen bg-gray-100 p-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Votos ' . $voting->name) }}
        </h2>
    </x-slot>

    <!-- Filtros -->
    <div class="mx-auto max-w-7xl mb-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
            <!-- Filtro por Nome -->
            <input 
                type="text" 
                wire:model.live="filterName" 
                placeholder="Nome" 
                class="border border-gray-300 rounded px-2 py-1 focus:outline-none  
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
            />

            <!-- Filtro por Partido -->
            <input 
                type="text" 
                wire:model.live="filterParty" 
                placeholder="Partido" 
                class="border border-gray-300 rounded px-2 py-1 focus:outline-none 
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />

            <!-- Filtro por UF -->
            <input 
                type="text" 
                wire:model.live="filterUf" 
                placeholder="UF" 
                class="border border-gray-300 rounded px-2 py-1 focus:outline-none 
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
    </div>

    <!-- Listagem em Tabela -->
    <div class="mx-auto max-w-7xl bg-white shadow p-4 rounded">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Foto</th>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nome</th>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Partido / UF</th>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Voto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($votes as $vote)
                        <tr>
                            <!-- Foto -->
                            <td class="px-4 py-1 whitespace-nowrap">
                                <img  
                                    src="{{ $vote->senator->image_profile }}" 
                                    alt="Foto de {{ $vote->senator->name }}" 
                                    class="h-16 w-16 object-cover rounded-full"
                                >
                            </td>

                            <!-- Nome -->
                            <td class="px-4 py-1 whitespace-nowrap">
                                <div class="font-semibold text-gray-800">
                                    {{ $vote->senator->name }}
                                </div>
                            </td>

                            <!-- Partido / UF -->
                            <td class="px-4 py-1 whitespace-nowrap">
                                <div class="text-gray-600">
                                    {{-- Ajuste conforme sua model/relacionamento. Exemplo: --}}
                                    {{ $vote->senator->party->name ?? 'Sem Partido' }} 
                                    - {{ $vote->senator->uf }}
                                </div>
                            </td>

                            <!-- Grupo de rádio: A FAVOR / Indefinido / Contra -->
                            <td class="px-4 py-1 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input
                                            type="radio"
                                            wire:model.live="voto.{{ $vote->id }}" 
                                            value="Y"
                                            class="form-radio text-indigo-600"
                                        >
                                        <span class="ml-2">{{ __('A Favor') }}</span>
                                    </label>

                                    <label class="inline-flex items-center">
                                        <input
                                            type="radio"
                                            wire:model.live="voto.{{ $vote->id }}"
                                            value="I"
                                            class="form-radio text-indigo-600"
                                        >
                                        <span class="ml-2">{{ __('Indefinido') }}</span>
                                    </label>

                                    <label class="inline-flex items-center">
                                        <input
                                            type="radio"
                                            wire:model.live="voto.{{ $vote->id }}"
                                            value="N"
                                            class="form-radio text-indigo-600"
                                        >
                                        <span class="ml-2">{{ __('Contra') }}</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                {{ __('Nenhum senador encontrado.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginação (caso queira) -->
        @if(method_exists($votes, 'links'))
            <div class="mt-4">
                {{ $votes->links() }}
            </div>
        @endif
    </div>
</div>

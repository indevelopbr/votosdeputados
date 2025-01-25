<div class="min-h-screen bg-gray-100">
    {{-- Cabeçalho (caso use Jetstream ou layout similar) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Senadores') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensagem de sucesso (caso exista) --}}
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            {{-- Card com sombra --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <!-- Barra de filtros e botão de criar -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                    <!-- Filtro -->
                    <div class="w-full sm:w-1/2 mb-2 sm:mb-0">
                        <label for="search" class="sr-only">Filtrar Senadores</label>
                        <input 
                            type="text" 
                            wire:model="search" 
                            id="search"
                            placeholder="Filtrar senadores..."
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 
                                   focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-4 py-2"
                        />
                    </div>
                    
                    <!-- Botão que aciona o modal -->
                    <button 
                        wire:click="showCreateModal"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent 
                               rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                               hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none 
                               focus:border-indigo-900 focus:ring ring-indigo-300"
                    >
                        Criar Senador
                    </button>
                </div>

                <!-- Tabela de Senadores -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">
                                    Partido
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">
                                    Criado em
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($senators as $senador)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $senador->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $senador->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $senador->party->name . ' - ' . $senador->uf }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $senador->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <!-- Botões de ação -->
                                        <div class="inline-flex space-x-1">
                                            <!-- Botão de Editar -->
                                            <a 
                                                href="{{ route('senadores.editar', $senador->id) }}"
                                                class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm 
                                                       rounded-md focus:outline-none focus:ring-2 
                                                       focus:ring-offset-2 focus:ring-blue-500"
                                            >
                                                Editar
                                            </a>

                                            <!-- Botão de Excluir -->
                                            <button 
                                                wire:click="delete({{ $senador->id }})"
                                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm 
                                                       rounded-md focus:outline-none focus:ring-2 
                                                       focus:ring-offset-2 focus:ring-red-500"
                                            >
                                                Excluir
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Nenhum senador encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Paginação -->
                    <div class="mt-4">
                        {{ $senators->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para criar/editar Senador -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <!-- Fundo escuro para o modal -->
            <div 
                class="absolute inset-0 bg-black bg-opacity-50"
                wire:click="closeModal"
            ></div>
            
            <!-- Conteúdo do modal -->
            <div class="bg-white rounded shadow-lg p-6 w-full max-w-lg z-50">
                <h2 class="text-xl font-bold mb-4">
                    {{ $modalTitle }}
                </h2>

                <div class="mb-4">
                    <label class="block font-semibold mb-1" for="nome">
                        Nome
                    </label>
                    <input 
                        type="text" 
                        wire:model="nome" 
                        id="nome" 
                        class="w-full border-gray-300 rounded-md shadow-sm 
                               focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                               focus:ring-opacity-50 px-4 py-2" 
                        placeholder="Digite o nome do Senador"
                    />
                    @error('nome') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <button 
                        wire:click="createOrUpdateSenator" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mr-2 
                               focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                        Salvar
                    </button>
                    <button 
                        wire:click="closeModal"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded 
                               focus:outline-none focus:ring-2 focus:ring-gray-500"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

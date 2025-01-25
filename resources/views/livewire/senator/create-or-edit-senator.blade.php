<div class="min-h-screen bg-gray-100">
    {{-- Caso use Jetstream ou layout similar --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Verifica se é edição ou criação --}}
            {{ $senatorId ? 'Editar Senador' : 'Criar Senador' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6">
                {{-- Formulário de criação/edição de Senador --}}
                <form wire:submit.prevent="saveSenator" enctype="multipart/form-data">
                    @csrf

                    {{-- Nome --}}
                    <div class="mb-4">
                        <label for="name" class="block font-bold text-gray-700 mb-1">Nome</label>
                        <input
                            type="text"
                            wire:model="name"
                            id="name"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="Nome completo"
                        />
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block font-bold text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            wire:model="email" 
                            id="email"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="Digite o email"
                        />
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Telefone --}}
                    <div class="mb-4">
                        <label for="phone" class="block font-bold text-gray-700 mb-1">Telefone</label>
                        <input 
                            type="text" 
                            wire:model="phone" 
                            id="phone"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="(XX) 99999-9999"
                        />
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- UF (Estado) --}}
                    <div class="mb-4">
                        <label for="uf" class="block font-bold text-gray-700 mb-1">UF</label>
                        <input 
                            type="text" 
                            wire:model="uf" 
                            id="uf"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="Ex: SP, RJ, MG..."
                            maxlength="2"
                        />
                        @error('uf')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Foto de Perfil --}}
                    <div class="mb-4">
                        <label for="image_profile" class="block font-bold text-gray-700 mb-1">Foto de Perfil</label>
                        <input 
                            type="file" 
                            wire:model="image_profile" 
                            id="image_profile"
                            class="w-full"
                        />
                        @error('image_profile')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        {{-- Pré-visualização (apenas se for um novo upload) --}}
                        @if ($image_profile && !$senatorId)
                            <div class="mt-2">
                                <img src="{{ $image_profile->temporaryUrl() }}" alt="Preview" class="h-24">
                            </div>
                        @endif

                        {{-- Se estiver editando, exibir a imagem atual, caso exista --}}
                        @if ($senatorId && !$image_profile && isset($senator->image_profile))
                            <div class="mt-2">
                                <img src="{{ Storage::url($senator->image_profile) }}" alt="Foto Atual" class="h-24">
                            </div>
                        @elseif ($senatorId && $image_profile && !is_string($image_profile))
                            <div class="mt-2">
                                <img src="{{ $image_profile->temporaryUrl() }}" alt="Preview" class="h-24">
                            </div>
                        @endif
                    </div>

                    {{-- Facebook --}}
                    <div class="mb-4">
                        <label for="facebook" class="block font-bold text-gray-700 mb-1">Facebook</label>
                        <input 
                            type="text" 
                            wire:model="facebook" 
                            id="facebook"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="URL do Facebook"
                        />
                        @error('facebook')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Instagram --}}
                    <div class="mb-4">
                        <label for="instagram" class="block font-bold text-gray-700 mb-1">Instagram</label>
                        <input 
                            type="text" 
                            wire:model="instagram" 
                            id="instagram"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="URL do Instagram"
                        />
                        @error('instagram')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Twitter --}}
                    <div class="mb-4">
                        <label for="twitter" class="block font-bold text-gray-700 mb-1">Twitter</label>
                        <input 
                            type="text" 
                            wire:model="twitter" 
                            id="twitter"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="URL do Twitter"
                        />
                        @error('twitter')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Site --}}
                    <div class="mb-4">
                        <label for="site" class="block font-bold text-gray-700 mb-1">Site</label>
                        <input 
                            type="text" 
                            wire:model="site" 
                            id="site"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                            placeholder="URL do site"
                        />
                        @error('site')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Data de Nascimento --}}
                    <div class="mb-4">
                        <label for="birth_date" class="block font-bold text-gray-700 mb-1">Data de Nascimento</label>
                        <input 
                            type="date" 
                            wire:model="birth_date" 
                            id="birth_date"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                        />
                        @error('birth_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Data de Reeleição --}}
                    <div class="mb-4">
                        <label for="re_election" class="block font-bold text-gray-700 mb-1">
                            Fim de Mandato
                        </label>
                        <input 
                            type="date" 
                            wire:model="re_election" 
                            id="re_election"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                        />
                        @error('re_election')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Partido (select) --}}
                    <div class="mb-4">
                        <label for="party_id" class="block font-bold text-gray-700 mb-1">Partido</label>
                        <select
                            wire:model="party_id"
                            id="party_id"
                            class="w-full border-gray-300 rounded-md shadow-sm 
                                   focus:border-indigo-500 focus:ring focus:ring-indigo-200 
                                   focus:ring-opacity-50 px-4 py-2"
                        >
                            <option value="">-- Selecione um Partido --</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->id }}">
                                    {{ $party->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('party_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Botões de ação --}}
                    <div class="flex justify-end">
                        <button 
                            type="submit"
                            class="mr-2 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent 
                                   rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                   hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-green-500"
                        >
                            Salvar
                        </button>

                        <a 
                            href="{{ route('senadores') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent 
                                   rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                                   hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-gray-500"
                        >
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

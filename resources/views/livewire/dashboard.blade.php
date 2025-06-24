<div class="">
   
    <div class="max-w-md mx-auto mt-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-black">Datos generales de la compañía</h2>
            @if(Auth::user()->company?->logo)
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('storage/' . Auth::user()->company->logo) }}" alt="Logo de la compañía" class="h-20 object-contain rounded border border-gray-300">
                </div>
            @endif
            <ul class="text-gray-700">
                <li><span class="font-semibold">Nombre:</span> {{ Auth::user()->company->legal_form ?? 'Sin asignar' }}</li>
                <li><span class="font-semibold">Email:</span> {{ Auth::user()->company->email ?? 'Sin asignar' }}</li>
                <li><span class="font-semibold">Teléfono:</span> {{ Auth::user()->company->phone ?? 'Sin asignar' }}</li>
                <li><span class="font-semibold">Dirección:</span> {{ Auth::user()->company->address ?? 'Sin asignar' }}</li>
            </ul>
        </div>
    </div>

</div>

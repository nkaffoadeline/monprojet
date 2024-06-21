
@if(session('success'))
<div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-sm mx-auto mt-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-green-500" role="button" onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Fermer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.697l-2.651 2.652a1.2 1.2 0 1 1-1.697-1.697L8.303 10 5.651 7.348a1.2 1.2 0 1 1 1.697-1.697L10 8.303l2.651-2.652a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
    </span>
</div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    

 @if(request()->query('create') == 'true')
 <div class="py-4">
            <a href="{{ request()->fullUrlWithQuery(['create' => 'false']) }}" style="padding: 8px 16px; background-color: green; color: white; border-radius: 4px;">Liste des réservations</a>
    </div>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf 
                    
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">Type de réservation</label>
                        <select name="type" id="type">
                            <option value="">Sélectionner le type</option>
                            <option value="chambre simple">Chambre simple</option>
                            <option value="chambre meublée">Chambre meublée</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">Montant</label>
                        <input type="number" name="prix" id="prix" readonly  required class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                        <input type="date" name="start_date" id="start_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                        <input type="date" name="end_date" id="end_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <button type="submit" style="padding: 8px 16px; background-color: green; color: white; border-radius: 4px;">Enregistrer la réservation</button>
                </form>

        @else

        <div class="py-4">
            <a href="{{ request()->fullUrlWithQuery(['create' => 'true']) }}" style="padding: 8px 16px; background-color: green; color: white; border-radius: 4px;">Créer une réservation</a>
        </div>
                <!-- Section pour afficher la liste des réservations -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Liste des Réservations</h2>
                    <div class="mt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                        Prix
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                        Date de début
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                        Date de fin
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                        Utilisateur
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $reservation->type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $reservation->prix }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $reservation->start_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $reservation->end_date }}
                                        </td>
                                        <!-- Ajout de la colonne pour le nom de l'utilisateur -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $reservation->user->name }}
                                        </td>
                                        <!-- Ajout de la colonne pour le bouton de suppression -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var prixParType = {
        "chambre simple": 15000, 
        "chambre meublée": 25000, 
    };

    var select = document.getElementById('type');
    var Prix = document.getElementById('prix');

    select.addEventListener('change', function() {
        var type = select.value;

        if (type && prixParType[type]) {
            Prix.value = prixParType[type];
        } else {
            Prix.value = ''; 
        }
    });
});
</script>
</x-app-layout>

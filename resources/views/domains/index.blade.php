<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Domeinnamen Overzicht</h2>
  </x-slot>

  <div class="p-6 bg-white shadow rounded">
    <table class="w-full table-auto">
      <thead>
        <tr>
          <th>Naam</th><th>Buy Now (€)</th><th>Min. bod (€)</th>
        </tr>
      </thead>
      <tbody>
      @forelse($domains as $domain)
        <tr>
          <td>{{ $domain->name }}</td>
          <td>{{ $domain->buy_now_price ?? '-' }}</td>
          <td>{{ $domain->minimum_bid ?? '-' }}</td>
        </tr>
      @empty
        <tr><td colspan="3">Geen domeinen gevonden.</td></tr>
      @endforelse
      </tbody>
    </table>

    <div class="mt-4">
      {{ $domains->links() }}
    </div>
  </div>
</x-app-layout>


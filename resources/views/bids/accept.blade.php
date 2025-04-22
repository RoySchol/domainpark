<x-app-layout>
  <x-slot name="header"><h2>Bod accepteren</h2></x-slot>
  <div class="p-6 bg-white">
    <p>Bieding van <strong>€{{ number_format($bid->amount,2) }}</strong> voor domein <strong>{{ $bid->domain->name }}</strong>.</p>
    <p>Klik op onderstaande knop om de betaling te voltooien.</p>
    <form method="POST" action="{{ route('bids.accept.process', [$bid, $bid->accept_token]) }}">
      @csrf
      <button type="submit" class="btn btn-primary mt-4">Betalen via Mollie</button>
    </form>
  </div>
</x-app-layout>


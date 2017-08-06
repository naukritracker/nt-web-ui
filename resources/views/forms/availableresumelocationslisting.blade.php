<div class="checkbox">
    <label>
        <input type="checkbox" class="location-list" data-id="0" id="0_location"> Any Location
    </label>
</div>

@foreach ($users as $user)
    @if ($user->currentlocation or $user->preferredlocation)
    <div class="checkbox">
        <label>
            <input type="checkbox" class="location-list" data-id="{{ $user->currentlocation->id ?: $user->preferredlocation->id }}" id="{{ $user->currentlocation->id }}_location">
            {{ $user->currentlocation->state ?: $user->preferredlocation->state }}({{ $user->preferredlocation->country->country }})
        </label>
    </div>
    @endif
@endforeach
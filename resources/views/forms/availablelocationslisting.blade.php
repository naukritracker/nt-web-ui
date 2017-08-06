<div class="checkbox">
    <label>
        <input type="checkbox" class="user-list" data-id="0" id="0_location"> Any Location
    </label>
</div>
@foreach ($statejobs as $job)
    @if ($job->state)
        <div class="checkbox">
            <label>
                <input type="checkbox" class="user-list" data-id="{{ $job->state_id }}" id="{{ $job->state_id }}_location">
                {{ $job->state->state }} / {{ $job->state->country->country }}
            </label>
        </div>
    @endif
@endforeach
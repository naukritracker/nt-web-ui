<div class="checkbox">
    <label>
        <input type="checkbox" class="industry-list" data-id="0" id="0_industry"> Any Industry
    </label>
</div>
@foreach ($users as $user)
    @if ($user->industries)
        <div class="checkbox">
            <label>
                <input type="checkbox" class="industry-list" data-id="{{ $user->industries->id }}" id="{{ $user->industries->id }}_industry">
                {{ $user->industries->industry }}
            </label>
        </div>
    @endif
@endforeach
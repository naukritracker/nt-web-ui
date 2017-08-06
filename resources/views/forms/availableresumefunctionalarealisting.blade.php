<div class="checkbox">
    <label>
        <input type="checkbox" class="functional-area-list" data-id="0" id="0_functional_area"> Any Function
    </label>
</div>
@foreach ($users as $user)
    @if ($user->functionalareas)
        <div class="checkbox">
            <label>
                <input type="checkbox" class="functional-area-list" data-id="{{ $user->functionalareas->id}}" id="{{ $user->functionalareas->id }}_functional_area">
                {{ $user->functionalareas->functional_area }}
            </label>
        </div>
    @endif
@endforeach
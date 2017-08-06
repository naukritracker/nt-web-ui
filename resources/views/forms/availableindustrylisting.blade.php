@foreach ($industryjobs as $job)
    @if ($job->industry != '')
        <div class="checkbox">
            <label>
                <input type="checkbox" class="industry-list" data-id="{{  $job->industry }}" id="{{ $job->industry }}_industry">
                {{ $job->industry }}
            </label>
        </div>
    @endif
@endforeach
@foreach ($companiesjob as $job)
    @if ($job->company)
        <div class="checkbox">
            <label>
                <input type="checkbox" class="company-list" data-id="{{ $job->company_id }}" id="{{  $job->company_id }}_company">
                {{ $job->company->name }}({{ $job->company->state->state }} / {{ $job->company->state->country->country }})
            </label>
        </div>
    @endif
@endforeach
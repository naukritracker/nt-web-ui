<ul class="lhs-nav">
    <li @if(route('EmployerProfile') == Request::url()) class="active" @endif>
        <a href="{{URL::route('EmployerProfile')}}" class="dashboard-icon">Dashboard</a>
    </li>
    <li @if(route('ResumeSearch') == Request::url()) class="active" @endif>
        <a href="{{URL::route('ResumeSearch')}}" class="search-icon">Search Resumes</a>
    </li>
    <li @if(route('ShowEmployerJobPosting') == Request::url()) class="active" @endif>
        <a href="{{URL::route('ShowEmployerJobPosting')}}" class="employment-dt-icon">Job Posting</a>
    </li>
</ul>
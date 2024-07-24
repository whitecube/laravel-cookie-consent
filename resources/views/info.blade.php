@foreach($cookies->getCategories() as $category)
<h3>{{ $category->title }}</h3>
<table>
    <thead>
        <th>@lang('cookieConsent::cookies.cookie')</th>
        <th>@lang('cookieConsent::cookies.purpose')</th>
        <th>@lang('cookieConsent::cookies.duration')</th>
    </thead>
    <tbody>
    @foreach($category->getCookies() as $cookie)
        <tr>
            <td>{{ $cookie->name }}</td>
            <td>{{ $cookie->description }}</td>
            <td>{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endforeach

@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                {{-- <img src="https://laravel.com/img/notification-logo-v2.1.png" class="logo" alt="Laravel Logo"> --}}
                {{-- <span style="font-size: 24px; font-weight: 700; color: #111827;">
                    {{ config('app.name') }}
                </span> --}}
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>

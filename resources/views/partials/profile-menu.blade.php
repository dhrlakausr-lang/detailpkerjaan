<style>
    .loker-profile {
        position: relative;
        display: inline-flex;
        align-items: center;
        font-family: "Plus Jakarta Sans", Arial, sans-serif;
    }

    .loker-profile summary {
        list-style: none;
    }

    .loker-profile summary::-webkit-details-marker {
        display: none;
    }

    .loker-profile-trigger,
    .loker-profile-login {
        display: inline-flex;
        min-height: 42px;
        align-items: center;
        gap: 10px;
        border: 1px solid #dbe7f3;
        border-radius: 999px;
        background: #ffffff;
        color: #1e3a5f;
        padding: 6px 12px 6px 7px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 8px 24px rgba(20, 35, 55, 0.08);
        cursor: pointer;
    }

    .loker-profile-login {
        padding: 7px 14px 7px 7px;
    }

    .loker-profile-avatar {
        display: grid;
        width: 32px;
        height: 32px;
        place-items: center;
        border-radius: 999px;
        background: #2563eb;
        color: #ffffff;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .loker-profile-menu {
        position: absolute;
        right: 0;
        top: calc(100% + 10px);
        z-index: 999;
        display: grid;
        min-width: 230px;
        gap: 8px;
        border: 1px solid #dbe7f3;
        border-radius: 14px;
        background: #ffffff;
        padding: 14px;
        color: #172033;
        box-shadow: 0 18px 44px rgba(20, 35, 55, 0.18);
    }

    .loker-profile-name {
        color: #172033;
        font-size: 14px;
        font-weight: 800;
    }

    .loker-profile-email {
        margin-top: -4px;
        color: #64748b;
        font-size: 12px;
    }

    .loker-profile-link,
    .loker-profile-logout {
        display: block;
        width: 100%;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: #2563eb;
        padding: 9px 10px;
        text-align: left;
        font: inherit;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .loker-profile-link:hover,
    .loker-profile-logout:hover {
        background: #eff6ff;
        color: #1d4ed8;
    }
</style>

@if($authProfile['logged_in'])
    <details class="loker-profile">
        <summary class="loker-profile-trigger">
            <span class="loker-profile-avatar">{{ $authProfile['initial'] }}</span>
            <span>{{ $authProfile['name'] }}</span>
            <i class="fa-solid fa-chevron-down"></i>
        </summary>
        <div class="loker-profile-menu">
            <div class="loker-profile-name">{{ $authProfile['name'] }}</div>
            @if($authProfile['email'])
                <div class="loker-profile-email">{{ $authProfile['email'] }}</div>
            @endif
            @if(($authProfile['role'] ?? 'user') === 'hr')
                <a class="loker-profile-link" href="{{ route('admin.lamaran.index') }}">Dashboard HR</a>
            @else
                <a class="loker-profile-link" href="{{ route('lamaran.status') }}">Status Lamaran</a>
            @endif
            <a class="loker-profile-link" href="{{ route('lamaran.index') }}">Form Lamaran</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="loker-profile-logout" type="submit">Logout</button>
            </form>
        </div>
    </details>
@else
    <a class="loker-profile-login" href="{{ route('login') }}">
        <span class="loker-profile-avatar">U</span>
        <span>Masuk</span>
    </a>
@endif

@if($authProfile['logged_in'])
    <details class="relative inline-flex items-center font-sans">
        <summary class="inline-flex min-h-[42px] cursor-pointer list-none items-center gap-2.5 rounded-full border border-[#dbe7f3] bg-white py-1.5 pl-[7px] pr-3 text-sm font-bold text-[#1e3a5f] no-underline shadow-[0_8px_24px_rgba(20,35,55,0.08)] marker:hidden max-[520px]:min-h-[38px] max-[520px]:gap-2 max-[520px]:py-1 max-[520px]:pl-1.5 max-[520px]:pr-2.5 max-[520px]:text-[13px] [&::-webkit-details-marker]:hidden">
            <span class="grid h-8 w-8 place-items-center rounded-full bg-[#2563eb] text-[13px] font-extrabold uppercase text-white max-[520px]:h-7 max-[520px]:w-7 max-[520px]:text-xs">{{ $authProfile['initial'] }}</span>
            <span class="max-[520px]:max-w-[92px] max-[520px]:overflow-hidden max-[520px]:text-ellipsis max-[520px]:whitespace-nowrap">{{ $authProfile['name'] }}</span>
            <i class="fa-solid fa-chevron-down"></i>
        </summary>
        <div class="absolute right-0 top-[calc(100%+10px)] z-[999] grid min-w-[230px] gap-2 rounded-[14px] border border-[#dbe7f3] bg-white p-3.5 text-[#172033] shadow-[0_18px_44px_rgba(20,35,55,0.18)] max-[520px]:right-[-4px] max-[520px]:max-w-[calc(100vw-24px)] max-[520px]:min-w-[230px]">
            <div class="text-sm font-extrabold text-[#172033]">{{ $authProfile['name'] }}</div>
            @if($authProfile['email'])
                <div class="-mt-1 text-xs text-[#64748b]">{{ $authProfile['email'] }}</div>
            @endif
            @if(($authProfile['role'] ?? 'user') === 'hr')
                <a class="block w-full rounded-[9px] px-2.5 py-[9px] text-left text-[13px] font-bold text-[#2563eb] no-underline hover:bg-[#eff6ff] hover:text-[#1d4ed8]" href="{{ route('admin.lamaran.index') }}">Dashboard HR</a>
            @else
                <a class="block w-full rounded-[9px] px-2.5 py-[9px] text-left text-[13px] font-bold text-[#2563eb] no-underline hover:bg-[#eff6ff] hover:text-[#1d4ed8]" href="{{ route('saved-jobs.index') }}">Lowongan Disimpan</a>
                <a class="block w-full rounded-[9px] px-2.5 py-[9px] text-left text-[13px] font-bold text-[#2563eb] no-underline hover:bg-[#eff6ff] hover:text-[#1d4ed8]" href="{{ route('lamaran.status') }}">Status Lamaran</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full cursor-pointer rounded-[9px] border-0 bg-transparent px-2.5 py-[9px] text-left font-[inherit] text-[13px] font-bold text-[#2563eb] hover:bg-[#eff6ff] hover:text-[#1d4ed8]" type="submit">Logout</button>
            </form>
        </div>
    </details>
@else
    <a class="inline-flex min-h-[42px] items-center gap-2.5 rounded-full border border-[#dbe7f3] bg-white py-[7px] pl-[7px] pr-3.5 text-sm font-bold text-[#1e3a5f] no-underline shadow-[0_8px_24px_rgba(20,35,55,0.08)] max-[520px]:min-h-[38px] max-[520px]:gap-2 max-[520px]:py-1 max-[520px]:pl-1.5 max-[520px]:pr-2.5 max-[520px]:text-[13px]" href="{{ route('login') }}">
        <span class="grid h-8 w-8 place-items-center rounded-full bg-[#2563eb] text-[13px] font-extrabold uppercase text-white max-[520px]:h-7 max-[520px]:w-7 max-[520px]:text-xs">U</span>
        <span>Masuk</span>
    </a>
@endif

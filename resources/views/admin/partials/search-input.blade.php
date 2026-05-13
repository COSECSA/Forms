{{-- Real-time debounced search. $placeholder is required, $search is the current value. --}}
<div class="px-5 py-3 border-b border-gray-100">
    <div class="relative max-w-sm">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
        </svg>
        <input
            id="table-search"
            type="search"
            value="{{ $search ?? '' }}"
            placeholder="{{ $placeholder }}"
            class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50
                   focus:outline-none focus:ring-2 focus:ring-[#0f2744]/20 focus:border-[#0f2744]
                   placeholder-gray-400"
            autocomplete="off"
        />
    </div>
</div>

<script>
(function () {
    let timer;
    document.getElementById('table-search').addEventListener('input', function () {
        clearTimeout(timer);
        const q = this.value.trim();
        timer = setTimeout(function () {
            const url = new URL(window.location.href);
            if (q) {
                url.searchParams.set('search', q);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.delete('page'); // reset to page 1 on new search
            window.location.href = url.toString();
        }, 350); // 350 ms debounce
    });
})();
</script>

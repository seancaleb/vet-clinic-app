{{-- [Component: Dialog] - responsible for displaying a dialog pop-up with an overlay --}}

@props(['overlayId', 'contentId', 'closeBtnId'])

<div {!! $attributes->merge([
    'id' => $overlayId,
    'data-state' => 'closed',
    'class' =>
        'fixed inset-0 z-50 bg-neutral-950/80 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fill-mode-forwards hidden',
]) !!}>
    <div {!! $attributes->merge([
        'id' => $contentId,
        'data-state' => 'closed',
        'class' =>
            'fixed left-[1.5rem] sm:left-[50%] top-[50%] right-[1.5rem] translate-x-0 sm:translate-x-[-50%] translate-y-[-50%] z-50 w-auto sm:w-full grid max-w-lg mx-auto sm:mx-0 gap-6 border bg-white p-6 shadow-lg duration-200 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 sm:data-[state=closed]:slide-out-to-left-1/2 data-[state=closed]:slide-out-to-top-[48%] sm:data-[state=open]:slide-in-from-left-1/2 data-[state=open]:slide-in-from-top-[48%] rounded-lg md:w-full fill-mode-forwards',
    ]) !!}>

        {{-- Header  --}}
        <div class="grid gap-1">
            {{ $header }}
            <div id="{{ $closeBtnId }}" class='absolute top-4 right-4 cursor-pointer'><svg
                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-x text-gray-500">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg></div>
        </div>

        {{-- Content  --}}
        <div>
            {{ $content }}
        </div>

        {{-- Footer  --}}
        <div>
            {{ $footer }}
        </div>
    </div>
</div>

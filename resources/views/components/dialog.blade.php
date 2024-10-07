<div id="popover-button"
    class="fixed inset-0 z-50 bg-neutral-950/80 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0">
    <div
        class="fixed left-[1.5rem] sm:left-[50%] top-[50%] right-[1.5rem] translate-x-0 sm:translate-x-[-50%] translate-y-[-50%] z-50 w-auto sm:w-full grid max-w-md mx-auto sm:mx-0 sm:max-w-lg gap-4 border bg-background p-6 shadow-lg duration-200 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 sm:data-[state=closed]:slide-out-to-left-1/2 data-[state=closed]:slide-out-to-top-[48%] sm:data-[state=open]:slide-in-from-left-1/2 data-[state=open]:slide-in-from-top-[48%] rounded-lg md:w-full">
        {{ $slot }}
    </div>
</div>

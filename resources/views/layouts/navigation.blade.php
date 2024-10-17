<aside id="menu-sidebar" data-state="closed"
    class="fixed top-0 bottom-0 left-0 bg-white border-r border-gray-300 min-w-[256px] z-[200] lg:z-10 transition ease-in-out data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:duration-300 data-[state=open]:duration-500 data-[state=closed]:slide-out-to-left data-[state=open]:slide-in-from-left lg:data-[state=closed]:slide-out-to-left-0 lg:data-[state=open]:slide-in-from-left-0 fill-mode-forwards">
    <div class="p-6">
        {{-- Close button  --}}
        <div id="menu-sidebar-close-button" class='absolute lg:hidden top-4 right-4 cursor-pointer'><svg
                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-x text-gray-500">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg></div>

        {{-- Navigation logo  --}}
        <div class="h-8 mb-6">
            <a href="{{ route('dashboard') }}">
                <x-application-logo />
            </a>
        </div>

        {{-- Navigation  --}}
        <div class="grid gap-6">
            {{-- General Navigation  --}}
            <div class="grid gap-2">
                <span class="text-xs text-gray-500">General</span>
                <ul class="grid gap-1">
                    <li><x-ui.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" class="w-6 h-6 text-gray-600">
                                <path fill="currentColor"
                                    d="M14 9q-.425 0-.712-.288T13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9zM4 13q-.425 0-.712-.288T3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13zm10 8q-.425 0-.712-.288T13 20v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21zM4 21q-.425 0-.712-.288T3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21z" />
                            </svg>
                            Dashboard</x-ui.nav-link></li>
                    <li><x-ui.nav-link :href="route('appointments.index')" :active="str_contains(Route::currentRouteName(), 'appointments')"><svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-600" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm8-7l8-5V6l-8 5l-8-5v2z" />
                            </svg>
                            Appointments</x-ui.nav-link></li>

                    @if (Auth::user()->role === 'admin')
                        <li><x-ui.nav-link :href="route('users.index')" :active="str_contains(Route::currentRouteName(), 'users')"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-gray-600" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 6v-.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2v.8q0 .825-.587 1.413T18 20H6q-.825 0-1.412-.587T4 18" />
                                </svg>

                                Users</x-ui.nav-link></li>
                    @endif
                </ul>
            </div>

            {{-- Settings Navigation  --}}
            <div class="grid gap-2">
                <span class="text-xs text-gray-500">Settings</span>
                <ul class="grid gap-1">
                    <li><x-ui.nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"><svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-600" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M14 20v-1.25q0-.4.163-.763t.437-.637l4.925-4.925q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-4.925 4.925q-.275.275-.637.425t-.763.15H15q-.425 0-.712-.288T14 20M4 19v-1.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13q.925 0 1.825.113t1.8.362l-2.75 2.75q-.425.425-.65.975T12 18.35V20H5q-.425 0-.712-.288T4 19m16.575-3.6l.925-.975l-.925-.925l-.95.95zM12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12" />
                            </svg>

                            Profile</x-ui.nav-link></li>
                    {{-- FIXME: Implement the POST request for logout --}}
                    <li class="flex items-center gap-3 text-gray-500 font-medium text-[0.9375rem] ">
                        <form method="POST" action="{{ route('logout') }}" class="w-full"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            @csrf
                            <x-ui.nav-link :href="route('logout')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h6q.425 0 .713.288T12 4t-.288.713T11 5H5v14h6q.425 0 .713.288T12 20t-.288.713T11 21zm12.175-8H10q-.425 0-.712-.288T9 12t.288-.712T10 11h7.175L15.3 9.125q-.275-.275-.275-.675t.275-.7t.7-.313t.725.288L20.3 11.3q.3.3.3.7t-.3.7l-3.575 3.575q-.3.3-.712.288t-.713-.313q-.275-.3-.262-.712t.287-.688z" />
                                </svg>
                                Log out
                            </x-ui.nav-link>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>

<div id="overlay" data-state="closed"
    class="fixed inset-0 z-[100] bg-black/80 data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 hidden fill-mode-forwards">
</div>

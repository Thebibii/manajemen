@props(['title', 'desc' => '', 'headerClass' => ''])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-gray-200 bg-white']) }}>
    <!-- Card Header -->
    <div class="flex items-center justify-between px-6 py-5 gap-y-4 {{ $headerClass }}">
        <div>
            <h3 class="text-lg font-medium text-gray-800">
                {{ $title }}
            </h3>
            @if ($desc)
                <p class="mt-1 text-base text-gray-500">
                    {{ $desc }}
                </p>
            @endif
        </div>

        <!-- Slot Tombol di Sini -->
        @if (isset($action))
            <div class=" flex-shrink-0">
                {{ $action }}
            </div>
        @endif
    </div>

    <!-- Card Body -->
    <div class="p-4 border-t border-gray-100 sm:p-6">
        <div class="space-y-6">
            {{ $slot }}
        </div>
    </div>
</div>

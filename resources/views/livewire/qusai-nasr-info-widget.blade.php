<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex-1">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('filament-panels::widgets/qusai-nasr-info-widget.made_by') }}
                </p>

                <h2
                    class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                >
                    {{ __('filament-panels::widgets/qusai-nasr-info-widget.qusai_nasr') }} - ProCoders
                </h2>

            </div>

            <div class="flex flex-col items-end gap-y-1">
                <x-filament::link
                    color="gray"
                    href="https://gravatar.com/qusainasr"
                    icon="heroicon-m-identification"
                    icon-alias="panels::widgets.filament-info.open-documentation-button"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    {{ __('filament-panels::widgets/qusai-nasr-info-widget.contact') }}
                </x-filament::link>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

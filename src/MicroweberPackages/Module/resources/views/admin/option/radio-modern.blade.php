

<div>
    <x-microweber-ui::radio-modern
        wire:model.debounce.100ms="state.settings.{{ $this->optionKey }}"
        selectedOption="{{$this->state['settings'][$this->optionKey]}}"
        :options="$radioModernOptions" />
</div>
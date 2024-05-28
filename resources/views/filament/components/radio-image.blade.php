<div class="grid grid-cols-3 gap-4" wire:key="{{ $getName() }}">
    @foreach ($getOptions() as $data)
        <label class="flex flex-col items-center cursor-pointer" wire:key="option-{{ $getName() }}">
            <!-- Bind the input to LiveWire's model and handle changes reactively -->
            <input type="radio" id="option-{{ $data['id'] }}"
                   wire:model="data.{{ $getName() }}"
                   name="{{ $getName() }}"
                   value="{{ $data['id'] }}"
                   {{ $getDefaultValue() == $data['id'] ? 'checked' : '' }}>
            <!-- Display the image using asset and handle dimensions -->
            <img src="{{ asset($data['img_path']) }}" title="{{ $data['name'] }}" alt="{{ $data['name'] }}" class="w-full h-auto mt-2">
        </label>
    @endforeach
</div>

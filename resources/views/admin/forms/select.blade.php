@if(isset($relations) && $relations)
<x-adminlte-select2 class="select2" name="{{$name}}" id="{{$id}}" label="{{__('cruds.'.$name)}}" label-class="text-lightblue" igroup-size="sm" data-placeholder="{{__('cruds.'.$name)}}">
    <x-slot name="prependSlot">
        <div class="input-group-text bg-lightblue">
            <i class="fas fa-{{$icon ?? 'car-side'}}"></i>
        </div>
    </x-slot>
    @if(isset($relations[$data]))
      @foreach($relations[$data] as $item)
      <option value="{{$item[$data_save_item]}}">{{$item[$data_display_item]}}</option>
      @endforeach
    @endif
</x-adminlte-select2>
@endif
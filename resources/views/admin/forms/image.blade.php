<x-adminlte-input-file name="ifPholder" igroup-size="sm" name="{{$name}}" id="{{$id}}"  label="{{__('cruds.'.$name)}}" label-class="text-lightblue"  placeholder="{{__('cruds.'.$name)}}">
    <x-slot name="prependSlot">
        <div class="input-group-text bg-lightblue">
            <i class="fas fa-{{$icon ?? 'upload'}}"></i>
        </div>
    </x-slot>
</x-adminlte-input-file>
<input type="hidden" name="type" value="{{$type}}">
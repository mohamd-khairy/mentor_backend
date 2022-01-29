<x-adminlte-input-date name="ifPholder" type="{{$type}}" igroup-size="sm"  label-class="text-lightblue" name="{{$name}}" id="{{$id}}" label="{{__('cruds.'.$name)}}">
   <x-slot name="prependSlot">
      <div class="input-group-text bg-lightblue">
         <i class="fas fa-{{$icon ?? 'upload'}}"></i>
      </div>
   </x-slot>
</x-adminlte-input-date>
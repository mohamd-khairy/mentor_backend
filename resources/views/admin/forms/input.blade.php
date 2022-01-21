@if(isset($translate) && $translate)
   <x-adminlte-input type="{{$type}}" igroup-size="sm" value="{{old($name.'_en' , '')}}" name="{{$name.'_en'}}" id="{{$id}}" label="{{__('cruds.'.$name.'_en')}}" placeholder="{{__('cruds.'.$name.'_en')}}" top-class="col-md-6" label-class="text-lightblue">
      <x-slot name="prependSlot">
         <div class="input-group-text ">
            <i class="fas fa-{{$icon ?? 'user'}} text-lightblue"></i>
         </div>
      </x-slot>
   </x-adminlte-input>


   <x-adminlte-input type="{{$type}}" igroup-size="sm" value="{{old($name.'_ar' , '')}}" name="{{$name.'_ar'}}" id="{{$id}}" label="{{__('cruds.'.$name.'_ar')}}" placeholder="{{__('cruds.'.$name.'_ar')}}" top-class="col-md-6" label-class="text-lightblue">
      <x-slot name="prependSlot">
         <div class="input-group-text ">
            <i class="fas fa-{{$icon ?? 'user'}} text-lightblue"></i>
         </div>
      </x-slot>
   </x-adminlte-input>
@else

<x-adminlte-input type="{{$type}}" igroup-size="sm" value="{{old($name , '')}}" name="{{$name}}" id="{{$id}}" label="{{__('cruds.'.$name)}}" placeholder="{{__('cruds.'.$name)}}" top-class="col-md-6" label-class="text-lightblue">
   <x-slot name="prependSlot">
      <div class="input-group-text ">
         <i class="fas fa-{{$icon ?? 'user'}} text-lightblue"></i>
      </div>
   </x-slot>
</x-adminlte-input>

@endif
@if(isset($translate) && $translate)

<div class="row">
   <div class=" col-6">
      <x-adminlte-textarea rows="3" type="{{$type}}" igroup-size="sm" value="{{old($name.'_en' , '')}}" name="{{$name.'_en'}}" id="{{$id}}" label="{{__('cruds.'.$name.'_en')}}" placeholder="{{__('cruds.'.$name.'_en')}}" label-class="text-lightblue">
         <x-slot name="prependSlot">
            <div class="input-group-text ">
               <i class="fas fa-{{$icon ?? 'user'}} text-lightblue"></i>
            </div>
         </x-slot>
      </x-adminlte-textarea>
   </div>

   <div class=" col-6">
      <x-adminlte-textarea rows="3" type="{{$type}}" igroup-size="sm" value="{{old($name.'_ar' , '')}}" name="{{$name.'_ar'}}" id="{{$id}}" label="{{__('cruds.'.$name.'_ar')}}" placeholder="{{__('cruds.'.$name.'_ar')}}" label-class="text-lightblue">
         <x-slot name="prependSlot">
            <div class="input-group-text ">
               <i class="fas fa-{{$icon ?? 'user'}} text-lightblue"></i>
            </div>
         </x-slot>
      </x-adminlte-textarea>
   </div>
</div>
@else

<x-adminlte-textarea rows="3" type="{{$type}}" igroup-size="sm" value="{{old($name , '')}}" name="{{$name}}" id="{{$id}}" label="{{__('cruds.'.$name)}}" placeholder="{{__('cruds.'.$name)}}" top-class="col-md-6" label-class="text-lightblue">
   <x-slot name="prependSlot">
      <div class="input-group-text ">
         <i class="fas fa-{{$icon ?? 'user'}} text-lightblue"></i>
      </div>
   </x-slot>
</x-adminlte-textarea>

@endif
<div class="p6">
    <x-jet-button wire:click="createShowModal" class="my-5 mx-3 d-flex">
        {{__('Create New +')}} 
    </x-jet-button>
    {{-- the data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Link
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Content
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                      Actions
                    </th>
                  
                    
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                   @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$item->title}}
                                        {!! $item->is_default_home ? '<span class="text-green-400 text-sm">[Default Home page]</span>':''!!}
                                        {!! $item->is_default_not_found ? '<span class="text-red-400 text-sm">[Default 404]</span>':''!!}
                                    
                                      </div>
                                    
                                    </div>
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-blue-900">
                                  <a href="{{url('/'.$item->slug)}}">
                                  {{$item->slug}}</a>
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    {!! $item-> content !!}
                                </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                   <div class="text-center">
                                    <x-jet-button wire:click="updateShowModal({{$item->id}})" class="my-5">
                                        {{__('Update')}}
                                    </x-jet-secondary-button>
                                    <x-jet-danger-button wire:click="deleteShowModal({{$item->id}})" class="my-5 ">
                                        {{__('Delete')}}
                                    </x-jet-danger-button>
                                   </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    No Records Found
                                </td>
                            </tr>

                   @endif
                  
                  <!-- More items... -->
                
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <div class="m-3">  {{$data->links()}}</div>
      </div>

    {{-- Modal form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Page') }} {{$modelId}}
        </x-slot>

        <x-slot name="content">
          <div class="mt-4">
            <x-jet-label for="title" value="{{ __('Title') }}" />
            <x-jet-input id="title" type="text" class="mt-1 block w-full" name="title" wire:model.debounce.800ms="title"/>
            @error('title') <span class="error">{{ $message }}</span> @enderror
          </div>

          <div class="mt-4">
            <x-jet-label for="slug" value="{{ __('Slug') }}"  />
            <x-jet-input  id="slug" type="text" class="mt-1 block w-full text-gray-400" name="slug" wire:model.debounce.800ms="slug">
            </x-jet-input>
            
            @error('slug') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="mt-4">
            <label for="">
              <input class="form-checkbox" type="checkbox" value="{{$isSetToDefaultHomePage}}" wire:model="isSetToDefaultHomePage" />
              <span class="text-gray-400 text-sm">Set as Default home page</span>
            </label>
          </div>
          <div class="mt-4">
            <label for="">
              <input class="form-checkbox" type="checkbox" value="{{$isSetToDefaultNotFoundPage}}" wire:model="isSetToDefaultNotFoundPage" />
              <span class="text-red-400 text-sm">Set as Default 404 error page </span>
            </label>
          </div>
          <div class="mt-4">
            <x-jet-label for="title" value="{{ __('Content') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">                      
                        <div class="body-npm" wire:ignore>                            
                            <trix-editor
                                class="trix-content"
                                x-ref="trix"
                                wire:model.debounce.100000ms="content"
                                wire:key="trix-content-unique-key"
                            ></trix-editor>
                        </div>
                    </div>
                
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div></div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>
            @if($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }} 
            </x-jet-danger-button>
            @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Save') }} 
            </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

     {{-- The Delete Modal --}}

     <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
      <x-slot name="title">
          {{ __('Delete Page') }}
      </x-slot>

      <x-slot name="content">
          {{ __('Are you sure you want to delete this page? Once the page is deleted, all of its resources and data will be permanently deleted.') }}
      </x-slot>

      <x-slot name="footer">
          <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
              {{ __('Nevermind') }}
          </x-jet-secondary-button>

          <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
              {{ __('Delete Page') }}
          </x-jet-danger-button>
      </x-slot>
  </x-jet-dialog-modal>
</div>

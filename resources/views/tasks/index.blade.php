<style>
  .form-control{
      width:80%;
     padding: 15px;
     margin-top:20px;
  } 
  .send-btn{
      
      padding: 10px;
      border-radius: 5px;
      margin-top: 10px;
    
  }
  .modal-create{
    /* display: none; */
    position: absolute;
    background-color: white;
    border:1px solid black;
    
  }
  #modal{
    display:none;
  }
</style>  
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight active">
            {{ __('Task List') }}
        </h2>
    </x-slot>
    {{-- Inctive Modal --}}
    <div class="py-6" id="modal">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-6" >
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg " >
                <div class="modal-create"style="background-color: white;"  >
              <form action="{{url('store')}}" method="post" >
                  @csrf
                <div class="text-center">
                    <h3>Create Task</h3>
                  <input type="text" placeholder="title" name="title" class="form-control">
                  <input type="text" placeholder="description" name="description" class="form-control">
                  <input type="text" placeholder="status" name="status" class="form-control">
                  <input type="text" placeholder="assigned to" name="assigned_to" class="form-control"><br>
                  {{-- <input type="submit" class="send-btn"> --}}
                  <x-jet-button class="send-btn" type="submit">Save</x-jet-danger-button>
                  <x-jet-danger-button class="send-btn"><a href="/tasks">back</x-jet-danger-button></a>
                </div>
                  </form>
                </div>
          </div>
      </div>
  </div>
 
  
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
              <x-jet-button class="m-5"><a href="{{url('/create')}}">Create New Task</x-jet-button></a>
              <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200" >
                        <thead class="bg-gray-50">
                          <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Title
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              description
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              assigned to
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @if ($tasks->count())
                         @foreach ($tasks as $task)
                         <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{$task->title}}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">  {{$task->description}}</div>
                            
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                             {{$task->status}}
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$task->assigned_to}}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <x-jet-danger-button><a href="{{url('/delete/'.$task->id)}}">Delete</a></x-jet-danger-button>
                            <x-jet-button><a href="{{url('/edit/'.$task->id)}}">Update</a></x-jet-danger-button>
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
              </div>
            </div>
        </div>
        
    </div>
    
   
</x-app-layout>

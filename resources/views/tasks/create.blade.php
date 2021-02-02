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
</style>  
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight active">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                  
                <form action="{{url('store')}}" method="post" >
                    @csrf
                  <div class="text-center">
                    <h1>Create Task</h1>
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

</x-app-layout>

   

<div class="divide-y divide-gray-800" x-data="{open :false}"  >
    <nav class="flex items-center bg-gray-900 px-3 py-2 shadow-lg">
        <div>
            <button @click="open = !open"  class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                <svg class="w-8 fill-current" viewBox="0 0 24 24">                            
                    <path x-show="!open"  fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    <path  x-show="open" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
        <div class="h-12 w-full flex items-center">
            <a href="{{ url('/')}}" class="w-full">
                <img class="" src="{{ url('/img/logo.png')}}" />
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
            {{-- Top Navigation --}}
            @if ($user = Auth::user())
                @foreach ($TopNavLinks as $topnav)
                <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                            <li class="cursor-pointer  px-4 py-2 hover:bg-gray-800"><a href="{{url('/'.$topnav->slug)}}">{{$topnav->slug}}</a></li>
                        </a>
                </ul>
                @endforeach
            @else
                <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                    <li class="cursor-pointer border-2 px-4 py-2 hover:bg-gray-800"><a href="{{url('/login')}}">login</a></li>
                </a>
                </ul>
            @endif
        </div>
    </nav>
    <div class="sm:flex sm:min-h-screen">
        <aside class="bg-gray-900 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12">
            {{-- Desktop Web View --}}
            <ul class="hidden text-gray-200 text-xs sm:block sm:text-left">
               @foreach ($sideBarLinks as $side)

               <a href="{{url('/'.$side->slug)}}">
                <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{$side->slug}}</li>
                </a>

               @endforeach
                        

                        {{-- <a href="{{url('/aboutpage')}}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">About</li>
                        </a>

                        <a href="{{url('/contact')}}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Contact</li>
                        </a>
                         --}}
                  
                              
            </ul>

            {{-- Mobile Web View --}}
            <div class="pb-3 divide-y divide-gray-800 block sm:hidden"
            :class="open ? 'block': 'hidden'"
            >
           
            
                @foreach ($sideBarLinks as $side)
                <ul class="text-gray-200 text-xs ">
                            <a href="{{url('/'.$side->slug)}}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{$side->slug}}</li>
                            </a>
                 
                @endforeach
            </ul>

                {{-- Top Navigation Mobile Web View --}}
                <ul class="text-gray-200 text-xs pt-4">   
                    @if($user = Auth::user())
                        @foreach($TopNavLinks as $topnav)
                    <a href="{{url('/'.$topnav->slug)}}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{$topnav->slug}}</li>
                    </a> 
                    @endforeach
                   @endif
                        
                </ul>
            </div>
        </aside> 
            <main class="bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12" >
                <section class="divide-y text-gray-900">   
                
                
                    
                    <h1 class="text-3xl font-bold">{{ $title }}</h1>
                    <article>
                        <div class="mt-5 text-sm">                        
                            {!! $content !!}
                        </div>
                    </article>
                </section>
            </main>
    </div>    
</div>
@if(session()->has('message'))
<div class="alert bg-green-400 border-t-4 border-teal-600 rounded text-white px-4 py-3 shadow-md my-5 mb-10">
        <p class="font-bold">{{session('message')}}</p> 
</div>
@endif

@if(session()->has('success'))
<div class="alert bg-green-400 border-t-4 border-green-600 rounded text-white px-4 py-3 shadow-md my-5 mb-10">
        <p class="font-bold">{{session('success')}}</p> 
</div>
@endif

@if(session()->has('error'))
<div class="alert bg-red-400 border-t-4 border-red-600 rounded text-white px-4 py-3 shadow-md my-5 mb-10">
        <p class="font-bold">{{session('error')}}</p> 
</div>
@endif



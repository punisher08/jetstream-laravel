    <form action="{{url('store')}}" method="post">
    @csrf
    <input type="text" placeholder="title" name="title">
    <input type="text" placeholder="description" name="description">
    <input type="submit">
   
    </form>
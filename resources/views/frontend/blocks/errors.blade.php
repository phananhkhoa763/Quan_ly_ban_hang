@if(count($errors)>0)
    <div class="alert alert-danger">
         <ul>
              @foreach($errors->all() as $err)
                 <li>{{$err}}<br></li>
               @endforeach
          </ul>
    </div>
@endif
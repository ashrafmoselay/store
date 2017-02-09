<option value="">--- Select Client ---</option>
@foreach(\App\Clients::get() as $client)
	<option value="{{$client->id}}">{{$client->name}}</option>
@endforeach
@extends('layouts.master')

@section('content')

	<h2>Template de usuários</h2>

	<ul>

		@foreach($usuarios as $usuario)

			<li>{{ $usuario->name }}</li>	

		@endforeach

	</ul>

@endsection
@extends('layouts.public')

@section('content')

    <!-- Horizontal Form -->
    <div class="box box-info col-md-6 col-md-offset-3 box-login">

        <div class="box-header with-border">
            <h3 class="box-title">Login</h3>
        </div><!-- /.box-header -->

        {{-- Formulário de Login --}}

        <form class="form-horizontal">

            {{-- Proteção CSRF --}}
            {!! csrf_field() !!}

            <div class="box-body">

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Lembrar de mim
                            </label>
                        </div>
                    </div>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Entrar</button>
            </div><!-- /.box-footer -->
        </form>
    </div>

@endsection
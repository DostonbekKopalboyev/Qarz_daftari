@extends('admin.layout.app')
@section('content')

    <div class="container" style="margin-top: 22px">
        <div class="row">
            <div class="col-md-12">
                <h2>@lang('message.update_data')</h2>
                <form method="POST" action="{{ route('updatePassword') }}">
                    @csrf

                    <div class="col-md-5">
                        <label class="form-label">@lang('message.old_password')</label>
                        <input type="password" class="form-control" name="old_password">
                    </div>
                    <br>

                    <div class="col-md-5">
                        <label class="form-label">@lang('message.new_password')</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>
                    <br>

                    <div class="col-md-5">
                        <label class="form-label">@lang('message.new_password_2')</label>
                        <input type="password" class="form-control" name="confirm_password" >
                    </div>


                    <button type="submit" class="btn btn-primary" style="margin: 10px;">@lang('message.update_button')</button>
                    <a href="{{route('admin.index')}}" class="btn btn-danger">@lang('message.back_button')</a>
                </form>
                </form>
            </div>
        </div>
    </div>

@endsection

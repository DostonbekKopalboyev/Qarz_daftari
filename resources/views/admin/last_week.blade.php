@extends('admin.layout.app')
@section('content')


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col p-md-0" >

                {{--                    modal uchun button--}}
                <a href="{{url('message')}}"  style="margin: 30px;" class="btn btn-danger"> @lang('message.exit')</a>

                <table class="table table-hover mt-5" style="width: 100%;">
                    <thead>
                    <tr>

                        <th style="width: 5%;">
                            @lang('message.id')
                        </th>
                        <th style="width: 15%;">
                            @lang('message.cust_name')
                        </th>
                        <th style="width: 15%;">
                            @lang('message.user_name')
                        </th>
                        <th style="width: 20%;">
                            @lang('message.product')
                        </th>
                        <th style="width: 15%;">
                            @lang('message.cost')
                        </th>
                        <th style="width: 15%;">
                            @lang('message.end_day')
                        </th>
                        <th style="width: 15%;">
                            @lang('message.time_taken')
                        </th>
                        {{--                                <th>--}}
                            {{--                                    @lang('message.status')--}}
                            {{--                                </th>--}}
                    </tr>
                    </thead>
                    @php
                        $i=1;
                    @endphp
                    <tbody>
                    @foreach($debts as $debt)
                    <tr style="color:red;">
                        <td>{{$i++}}</td>
                        <td>{{$debt->costumer->name}}</td>
                        <td>{{$debt->user->name}}</td>
                        <td>{{$debt->product}}</td>
                        <td><span class="money">{{$debt->quantity}}</span></td>
                        <td>{{$debt->end_day}}</td>
                        <td>{{$debt->created_at}}</td>
                        {{--                                    <td>{{$debt->status}}</td>--}}
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                {{--                    {{$debts->links()}}--}}

            </div>

        </div>

    </div>
</div>

@endsection

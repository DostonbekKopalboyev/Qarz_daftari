@extends('admin.layout.app')
@section('content')

    @if ($context === 'costumers')

    <div role="document">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col p-md-0" >

                        {{--                    modal uchun button--}}
                        <button type="button" id="showModal" style="margin: 30px;" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> @lang('message.create_button') </button>

                        <table class="table-bordered" style=" display: table;width: 100%;table-layout: fixed;">
                            <thead>
                            <tr style="text-align: center;">

                                <th style="width: 5%">
                                    @lang('message.id')
                                </th>
                                <th style="width: 15%">
                                    @lang('message.cust_name')
                                </th>
                                <th style="width: 15%">
                                    @lang('message.phone_num')
                                </th>
                                <th style="width: 15%">
                                    @lang('message.address')
                                </th>
                                <th style="width: 15%" >
                                    @lang('message.description')
                                </th>
                                <th style="width: 15%" >
                                    @lang('message.debt')
                                </th>
{{--                                <th style="width: 15%">--}}
{{--                                    @lang('message.status')--}}
{{--                                </th>--}}
                                <th style="width: 20%;display: inline-block;" >
                                    @lang('message.operation')
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
//                            @endphp
                            @foreach($costumers as $costumer)

                                <tr style="text-align: center;">
                                    <td>{{$i++}}</td>
                                    <td>{{$costumer->name}}</td>
                                    <td>{{$costumer->phone}}</td>
                                    <td>{{$costumer->address}}</td>
                                    <td>{{$costumer->description}}</td>
                                    <td><span class="money">{{$costumer->debt}}</span></td>
{{--                                    <td>{{$costumer->trust_status}}</td>--}}
                                    <td >
                                        @if(auth()->user()->hasRole('admin'))
                                            <form action="{{route('costumer.destroy', $costumer->id)}}" id="deleteCostumerForm{{$costumer->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="del({{$costumer->id}})" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <a onclick="func({{$costumer}}, '{{route('costumer.update', $costumer->id) }}')"
                                               id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-pencil"></i></a>
                                        @endif
                                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))
                                            <a href="{{route('debt_info',$costumer->id)}}" class="btn btn-primary"><i class="fa fa-wallet"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
{{--                        {{ $costumers->links() }}--}}

                    </div>

                </div>

            </div>
        </div>
    @endif


        @if ($context === 'debts')

            <div role="document">
                <div class="content-body">
                    <div class="container-fluid">
                        <div class="row page-titles mx-0">
                            <div class="col p-md-0" >

                                {{--                    modal uchun button--}}
                                <button type="button" id="showModal" style="margin: 30px;" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">@lang('message.create_button')</button>

                                <table class="table table-hover" style="width: 100%;">
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
                                            @lang('message.today_day')
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
                                        <tr>
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
{{--                                {{$debts->links()}}--}}

                            </div>

                        </div>

                    </div>
                </div>

        @endif

    @if ($context === 'payments')


            <div role="document">
                <div class="content-body">
                    <div class="container-fluid">
                        <div class="row page-titles mx-0">
                            <div class="col p-md-0" >

                                {{--                    modal uchun button--}}
                                <button type="button" id="showModal" style="margin: 30px;" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">@lang('message.create_button')</button>

                                <table class="table table-hover">
                                    <thead>
                                    <tr>

                                        <th>
                                            @lang('message.id')
                                        </th>
                                        <th>
                                            @lang('message.cust_name')
                                        </th>
                                        <th>
                                            @lang('message.user_name')
                                        </th>
                                        <th>
                                            @lang('message.payment')
                                        </th>
                                        <th>
                                            @lang('message.today_day')
                                        </th>
                                    </tr>
                                    </thead>
                                    @php
                                        $i=1;
                                    @endphp
                                    <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$payment->costumer->name}}</td>
                                            <td>{{$payment->user->name}}</td>
                                            <td><span class="money">{{$payment->quantity}}</span></td>
                                            <td>{{$payment->created_at}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{--{{$payments->links()}}--}}

                            </div>

                        </div>

                    </div>
                </div>

    @endif

    @if ($context === 'permissions')

                    <div role="document">
                        <div class="content-body">
                            <div class="container-fluid">
                                <div class="row page-titles mx-0">
                                    <div class="col p-md-0" >

                                        {{--                    modal uchun button--}}
                                        <a href="{{url('addUser')}}"  style="margin: 30px;" class="btn btn-success">@lang('message.create_button')</a>

                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">@lang('message.no')</th>
                                                <th scope="col">@lang('message.name')</th>
                                                <th scope="col">@lang('message.email')</th>
                                                <th scope="col">@lang('message.role')</th>
                                                <th scope="col">@lang('message.operation')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach($users as $user)
                                                <tr>
                                                    <th scope="row">{{$i++}}</th>
                                                    <td >{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>

                                                    <td>{{ $user->getRoleNames()->implode(',')}}</td>

                                                    <td>

                                                        <form action="{{url('destroy/'. $user->id)}}" id="deleteCostumerForm{{$user->id}}" method="GET">
                                                            @csrf
                                                            @method('DELETE')
                                                            @if(auth()->user()->hasPermissionTo('profile.destroy') && auth()->user()->hasRole('admin'))
                                                                <button onclick="del({{$user->id}})" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            @endif
                                                            <a class="btn btn-warning" href="{{url('editUser/'.$user->id)}}"> <i class="fa fa-pencil"></i> </a>
                                                            {{--                                            <a href="{{route('admin.permission',$user->id)}}" class="btn btn-primary"><i class="fa fa-user"></i></a>--}}

                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
{{--                                        {{ $users->links() }}--}}
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

        @endif


    @if ($context === 'messages')
                    <div class="content-body">
                        <div class="container-fluid">
                            <div class="row page-titles mx-0">
                                <div class="col p-md-0" >

                                    {{--                    modal uchun button--}}
                                    <a href="{{route('admin.last_week')}}" style="margin: 30px;" class="btn btn-success">@lang('message.last_week')</a>

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
    @endif


    @if ($context === 'last_weeks')

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
    @endif








        @endsection

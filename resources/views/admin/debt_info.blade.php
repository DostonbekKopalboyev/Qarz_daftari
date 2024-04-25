@extends('admin.layout.app')
@section('content')

    <div role="document">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col p-md-0" >

                        {{--                    modal uchun button--}}
                        <a href="{{url('costumer')}}" type="button"  style="margin: 30px;" class="btn btn-success" >@lang('message.back_button')</a>

                        <p>@lang('message.table_name_1')</p>
                        @unless(count($debts) == 0)

                        <table class="table table-hover">
                            <thead>
                            <tr>

                                <th>
                                    @lang('message.id')
                                </th>
                                <th>
                                    @lang('message.user_name')
                                </th>
                                <th>
                                     @lang('message.product')
                                </th>
                                <th>
                                     @lang('message.debt')
                                </th>
                                <th>
                                    @lang('message.date')
                                </th>
{{--                                <th>--}}
{{--                                    @lang('message.status')--}}
{{--                                </th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp

                            @foreach($debts as $debt)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$debt->user->name}}</td>
                                    <td>{{$debt->product}}</td>
                                    <td><span class="money">{{$debt->quantity}}</span></td>
                                    <td>{{$debt->created_at}}</td>
{{--                                    <td>{{$debt->status}}</td>--}}
                                </tr>
                            @endforeach
                            <tr>
                                <th>{{$debts->count('id')}}</th>
                                <th colspan="2" style="text-align: center">@lang('message.total')</th>

                                <th colspan="3"><span class="money">{{$debts->sum('quantity')}}</span></th>
                            </tr>
                            </tbody>
                        </table>

                        @else
                            <div class="card-header">
                                <div class="row content-end">
                                    <div class="col-4">
                                        @lang('message.qarz_mavjud_emas')
                                    </div>

                                </div>
                            </div>
                        @endunless

                        <br><br>
                        <p>@lang('message.table_name_2')</p>

                        @unless(count($payments) == 0)


                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    @lang('message.id')
                                </th>
                                <th>
                                    @lang('message.user_name')
                                </th>
                                <th>
                                    @lang('message.money')
                                </th>
                                <th>
                                    @lang('message.date')
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
                                    <td>{{$payment->user->name}}</td>
                                    <td><span class="money">{{$payment->quantity}}</span></td>
                                    <td>{{$payment->created_at}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>{{$payments->count('id')}}</th>
                                <th colspan="1" style="text-align: center">@lang('message.total')</th>
                                <th colspan="2" ><span class="money">{{$payments->sum('quantity')}}</span></th>
                            </tr>
                            </tbody>
                        </table>
                        @else
                            <div class="card-header">
                                <div class="row content-end">
                                    <div class="col-4">
                                        @lang('message.payment_mavjud_emas')
                                    </div>
                                </div>
                            </div>
                        @endunless

                    </div>

                </div>

            </div>
        </div>






@endsection

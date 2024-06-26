@extends('admin.layout.app')
@section('content')
    <div role="document">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col p-md-0" >

                        {{--                    modal uchun button--}}
                        <button type="button" id="showModal" style="margin: 30px;" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">@lang('message.create_button')</button>

                        @unless(count($debts) == 0)

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
                        @else
                            <div class="card-header">
                                <div class="row content-end">
                                    <div class="col-4">
                                        @lang('message.qarz_mavjud_emas')
                                    </div>

                                </div>
                            </div>
                        @endunless

                    </div>

                </div>

            </div>
        </div>


        {{--    create modal uchun--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('message.add_data')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('debt.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="title">@lang('message.select_cust')</label>
                            <select class="custom-select" style="" id="selectBox" required name="costumer_id"  onchange= "desc()">
                                @foreach($costumers as $costumer)
                                    <option value="{{$costumer->id}}">{{$costumer->name}}</option>
                                @endforeach
                            </select>

                            <label for="product">@lang('message.add_product')</label>
                            <input type="text" id="product" name="product" class="form-control" required>

                            <label for="quantity">@lang('message.add_cost_product')</label>
                            <input type="number" id="quantity" name="quantity" class="form-control"  class="money" required>

                            <label for="end_day">@lang('message.end_day')</label>
                            <input type="date" id="end_day" name="end_day" class="form-control" required>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
                                <button type="submit" class="btn btn-primary">@lang('message.save_button')</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <script>

            function desc(customer){

            }
        </script>
@endsection
@section('script')
            @if (session('success'))

                <script>

                    $(document).ready(function() {

                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,

                            title:'{{session('success')}}',
                            icon:'success',

                        });
                    });
                </script>

    @endif
     @if(session('error'))
                    <script>
                        $(document).ready(function() {
                        Swal.fire({
                            icon: "error",
                            title: "Xato...",
                            text: "Siz o'tib ketgan vaqtni kiritdingiz!",
                            // footer: '<a href="#">Why do I have this issue?</a>'
                        });
                        });
                    </script>
    @endif
@endsection

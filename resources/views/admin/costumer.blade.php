@extends('admin.layout.app')
@section('content')

    <div role="document">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col p-md-0" >

                        {{--                    modal uchun button--}}
                        <button type="button" id="showModal" style="margin: 30px;" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> @lang('message.create_button') </button>
                        @unless(count($costumers)==0)
                        <table class="table-bordered" style=" display: table;width: 100%;table-layout: fixed;" >
                            <thead class="header">
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
                                <th style="width: 20%;display: inline-block;" >
                                    @lang('message.operation')
                                </th>
                            </tr>
                            </thead>
                            <tbody id="Content" >
                            @php
                                $i=1;
                            @endphp
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
                        @else
                            <div class="card-header">
                                <div class="row content-end">
                                    <div class="col-4">
                                        @lang('message.mijoz_mavjud_emas')
                                    </div>
                                </div>
                            </div>
                        @endunless

                    </div>

                </div>

            </div>
        </div>

{{--        <tbody id="Content" class="searchdata"></tbody>--}}


        {{--    create modal uchun--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('message.enter_inform_cust')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('costumer.store')}}" id="myForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="name">@lang('message.enter_cust_name')</label>
                            <input type="text" id="name" name="name"  class="form-control" required>

                            <label for="phone">@lang('message.enter_cust_phone')</label>
                            <input type="number" id="phone" name="phone" class="form-control" required>

                            <label for="address">@lang('message.enter_cust_address')</label>
                            <input type="text" id="address" name="address" class="form-control">

                            <label for="description">@lang('message.enter_cust_description')</label>
                            <input type="text" id="description" name="description" class="form-control">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('message.close')</button>
                                <button type="submit" class="btn btn-primary">@lang('message.save_button')</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        {{--        modal update--}}
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ma'lumotlarni yangilash</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @unless(count($costumers)==0)

                    <form  action="{{route('costumer.update', $costumer->id)}}"  id="update_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <input id="fid" type="hidden" name="id" required>

                            <label for="name">Mijoz nomini yangilash</label>
                            <input type="text" id="fname" name="name" value="" class="form-control" required>

                            <label for="phone">Mijoz telefon raqamini yangilash</label>
                            <input type="text" id="fphone" name="phone" value="" class="form-control" required>

                            <label for="address">Mijoz manzilini yangilash</label>
                            <input type="text" id="faddress" name="address" class="form-control" value=""  required>

                            <label for="description">Mijoz tasvirini yangilash</label>
                            <input type="text" id="fdescription" name="description" value="" class="form-control">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
                                <button type="submit" class="btn btn-primary">Tahrirlash</button>
                            </div>
                        </div>
                    </form>
                    @else
                        <div class="card-header">
                            <div class="row content-end">
                                <div class="col-4">
                                    <h5>Mijoz mavjud emas</h5>
                                </div>
                            </div>
                        </div>
                    @endunless

                </div>

            </div>
        </div>



    </div>

@endsection
@section('script')
    <script>
        function func(costumer, route){
            console.log(costumer.name);
            document.getElementById('fid').value = costumer.id;
            document.getElementById('fname').value = costumer.name;
            console.log(costumer.phone);
            document.getElementById('fphone').value = costumer.phone;
            console.log(costumer.address);
            document.getElementById('faddress').value = costumer.address;
            console.log(costumer.description);
            document.getElementById('fdescription').value = costumer.description;
            var form = document.getElementById('update_form');
            form.setAttribute('action', route);
        }

        function del(id){
            Swal.fire({
                title: 'Haqiqatdanam o\'chirishni xohlaysizmi?',
                text: "O\'chirilgandan so\'ng siz uni qayta tiklay olmaysiz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ha, o\'chirilsin!',
                cancelButtonText: 'Bekor qilish',

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteCostumerForm'+id).submit();
                }
            })}

        $('.money').simpleMoneyFormat();
        console.log($('.money').text());
    </script>

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


                function validateInput() {
                const inputText = document.getElementById("phone").value;
                const isNumeric = /^[+0-9\s]+$/.test(inputText);

                if (isNumeric) {
                document.getElementById("myForm").submit();
            } else {
                alert("Iltimos raqam kiriting");
            }
            }
        </script>
    @endif


@endsection


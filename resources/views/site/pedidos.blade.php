@extends('site.home')
@section('content_home')

<div class="container_content_dashboad_header">
    <div class="container_content_dashboad_header_title">
    <h3>Pedidos</h3>
    <span>Pedidos</span>
    </div>
    <div class="container_content_dashboad_header_buttons">
    <button>
        <img src="{{URL::asset('assets/img/edit.png')}}" alt="edit">
        <div><span>Relatório de vendas</span></div>
    </button>
    <button>
        <img src="{{URL::asset('assets/img/edit.png')}}" alt="edit">
        <div><span>Editar pedido</span></div>
    </button>
    <button class="activebtn open">
        <img src="{{URL::asset('assets/img/plus.png')}}" alt="plus">
        <div><span>Add pedido</span></div>
    </button>
    </div>
</div>

<div class="container_content_dashboad_box">
    <div class="container_content_dashboad_box1">
    <div class="card">
        
    </div>
    </div>
    <div class="container_content_dashboad_box2">

    </div>
</div>

<script>
 
</script>
@stop

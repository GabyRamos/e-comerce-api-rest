@extends('layout.main') @section('content')
<section>
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				{{ Form::open(['route' => ['report.monthlySaleByWarehouse', $year], 'method' => 'post', 'id' => 'report-form']) }}
				<input type="hidden" name="warehouse_id_hidden" value="{{$warehouse_id}}">
				<h4 class="text-center">{{trans('file.Monthly Sale Report')}} &nbsp;&nbsp;
				<select class="selectpicker" id="warehouse_id" name="warehouse_id">
					<option value="0">{{trans('file.All Warehouse')}}</option>
					@foreach($lims_warehouse_list as $warehouse)
					<option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
					@endforeach
				</select>
				</h4>
				{{ Form::close() }}
				<div class="table-responsive mt-4">
					<table class="table table-bordered" style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
						<thead>
							<tr>
								<th><a href="{{url('report/monthly_sale/'.($year-1))}}"><i class="fa fa-arrow-left"></i> {{trans('file.Previous')}}</a></th>
						    	<th colspan="10" class="text-center">{{$year}}</th>
						    	<th><a href="{{url('report/monthly_sale/'.($year+1))}}">{{trans('file.Next')}} <i class="fa fa-arrow-right"></i></a></th>
						    </tr>
						</thead>
					    <tbody>
						    <tr>
                                <td><strong>Enero</strong></td>
                                <td><strong>Febrero</strong></td>
                                <td><strong>Marzo</strong></td>
                                <td><strong>Abril</strong></td>
                                <td><strong>Mayo</strong></td>
                                <td><strong>Junio</strong></td>
                                <td><strong>Julio</strong></td>
                                <td><strong>Agosto</strong></td>
                                <td><strong>Septiembre</strong></td>
                                <td><strong>Octubre</strong></td>
                                <td><strong>Noviembre</strong></td>
                                <td><strong>Deciembre</strong></td>
						    </tr>
						    <tr>
						    	@foreach($total_discount as $key => $discount)
						        <td>
						        	@if($discount > 0)
							      	<strong>{{trans("file.Product Discount")}}</strong><br>
							      	<span>{{$discount}}</span><br><br>
							      	@endif
							      	@if($order_discount[$key] > 0)
							      	<strong>{{trans("file.Order Discount")}}</strong><br>
							      	<span>{{$order_discount[$key]}}</span><br><br>
							      	@endif
							      	@if($total_tax[$key] > 0)
							      	<strong>{{trans("file.Product Tax")}}</strong><br>
							      	<span>{{$total_tax[$key]}}</span><br><br>
							      	@endif
							      	@if($order_tax[$key] > 0)
							      	<strong>{{trans("file.Order Tax")}}</strong><br>
							      	<span>{{$order_tax[$key]}}</span><br><br>
							      	@endif
							      	@if($shipping_cost[$key] > 0)
							      	<strong>{{trans("file.Shipping Cost")}}</strong><br>
							      	<span>{{$shipping_cost[$key]}}</span><br><br>
							      	@endif
							      	@if($total[$key] > 0)
							      	<strong>{{trans("file.grand total")}}</strong><br>
							      	<span>{{$total[$key]}}</span><br>
							      	@endif
						        </td>
						        @endforeach
						    </tr>
					    </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

	$("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #monthly-sale-report-menu").addClass("active");

	$('#warehouse_id').val($('input[name="warehouse_id_hidden"]').val());
	$('.selectpicker').selectpicker('refresh');

	$('#warehouse_id').on("change", function(){
		$('#report-form').submit();
	});
</script>
@endsection

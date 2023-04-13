@extends('layouts.main')
@section('title', 'قائمة الفواتير')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">
		<div class="mb-3 mb-xl-0">
			<div class="btn-group dropdown">
				<a href="{{route('invoices.create')}}"><button type="button" class="btn btn-primary">اضافة فاتورة</button></a>
			</div>
		</div>
	</div>
</div>

<div class="alerts-section">
  @if(session()->has('delete'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
</div>

<div class="row row-sm">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>
								<th class="border-bottom-0">رقم الفاتورة</th>
								<th class="border-bottom-0">تاريخ الفاتورة</th>
								<th class="border-bottom-0">تاريخ الاستحقاق</th>
								<th class="border-bottom-0">القسم</th>
								<th class="border-bottom-0">المنتج</th>
								<th class="border-bottom-0">نسبة الضريبة</th>
								<th class="border-bottom-0">قيمة الضريبة</th>
								<th class="border-bottom-0">الخصم</th>
								<th class="border-bottom-0">الاجمالى</th>
								<th class="border-bottom-0">الحالة</th>
								<th class="border-bottom-0">ملاحظات</th>
								<th class="border-bottom-0">مرفق</th>
								<th class="border-bottom-0">عمليات</th>
							</tr>
						</thead>
						<tbody>
              <?php $i = 0 ?>
              @foreach ($invoices as $invoice)
							<tr>
								<td> <?php $i++ ?> {{$i}} </td>
								<td> {{$invoice->invoice_number}} </td>
								<td> {{$invoice->invoice_date}} </td>
								<td> {{$invoice->invoice_due_date}} </td>
								<td> {{$invoice->section->section_name}} </td>
								<td> {{$invoice->invoice_product}} </td>
								<td> {{$invoice->invoice_rate_vat}} </td>
								<td> {{$invoice->invoice_value_vat}} </td>
								<td> {{$invoice->invoice_discount}} </td>
								<td> {{$invoice->invoice_total}} </td>
								<td> {{$invoice->invoice_status}} </td>
								<td> @if($invoice->invoice_note){{$invoice->invoice_note}}@else لم يتم العثور علي بيانات @endif </td>
								<td><a href="{{asset('files/'.$invoice->invoice_attachment)}}">عرض المرفق</a></td>
								<td>
									<!--<a class="btn btn-sm btn-info" href="#"><i class="fas fa-edit"></i></a>-->
                  <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $invoice->id }}" data-toggle="modal" data-target="#modaldemo9" href="#modaldemo9" title="حذف"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<!-- delete -->
	<div class="modal" id="modaldemo9">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content modal-content-demo">
				<div class="modal-header">
					<h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form action="invoices/destroy" method="post">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<div class="modal-body">
						<p>هل انت متاكد من عملية الحذف ؟</p><br>
						<input type="hidden" name="id" id="id" value="">
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-danger" value="تاكيد">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
  $('#modaldemo9').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
  })
</script>
@endsection
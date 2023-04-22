@extends('layouts.main')
@section('title', 'قائمة المنتجات')
@section('css')
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
			<h4 class="content-title mb-0 my-auto">قائمة المنتجات</h4>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">
		<div class="mb-3 mb-xl-0">
			<div class="btn-group dropdown">
        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">اضافة منتج</a>
			</div>
		</div>
	</div>
</div>

<div class="alerts-section">
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    @foreach ($errors->all() as $error)
      <strong>{{ $error }}</strong>
    @endforeach
  </div>
  @endif
  @if(session()->has('add'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session()->has('delete'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(session()->has('edit'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
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
					<table class="table key-buttons text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th class="wd-5p border-bottom-0">#</th>
								<th class="wd-15p border-bottom-0">اسم المنتج</th>
								<th class="wd-15p border-bottom-0">القسم</th>
								<th class="wd-20p border-bottom-0">ملاحظات</th>
								<th class="wd-15p border-bottom-0">العمليات</th>
							</tr>
						</thead>
						<tbody>
              <?php $i = 0 ?>
              @foreach ($products as $product)
							<tr>
								<td> <?php $i++ ?> {{$i}} </td>
								<td>{{$product->product_name}}</td>
								<td>{{$product->section->section_name}}</td>
                <td>@if($product->product_description){{$product->product_description}}@else لم يتم العثور علي بيانات @endif</td>
								<td>
                  <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-section_name="{{ $product->section->section_name }}" data-product_description="{{ $product->product_description }}" data-toggle="modal" data-target="#modaldemo2" href="#modaldemo2" title="تعديل"><i class="fas fa-edit"></i></a>
                  <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-toggle="modal" data-target="#modaldemo9" href="#modaldemo9" title="حذف"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
              @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

  <!-- create -->
  <div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{route('products.store')}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label>اسم المنتج <span>*</span></label>
              <input type="text" name="product_name" class="form-control">
            </div>
            <div class="form-group">
              <label for="section_id">اسم القسم <span>*</span></label>
              <select class="form-control" name="section_id" id="section_id">
                @foreach($sections as $section)
                  <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>ملاحظات</label>
              <input type="text" name="product_description" class="form-control">
            </div>
            <div class="modal-footer">
              <input class="btn ripple btn-primary" type="submit" value="اضافة">
              <input class="btn ripple btn-secondary" data-dismiss="modal" type="submit" value="الغاء">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- edit -->
	<div class="modal" id="modaldemo2">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">تعديل المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="products/update" method="post">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
              <input type="hidden" name="id" id="id" value="">
              <label>اسم المنتج <span>*</span></label>
              <input type="text" name="product_name" id="product_name" class="form-control">
            </div>
            <div class="form-group">
              <label class="">القسم <span>*</span></label>
              <select name="section_name" id="section_name" class="form-control">
                @foreach ($sections as $section)
                  <option>{{ $section->section_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>الملاحظات</label>
              <input type="text" name="product_description" id="product_description" class="form-control">
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn ripple btn-primary" value="تعديل">
              <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- delete -->
  <div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content modal-content-demo">
        <div class="modal-header">
          <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="products/destroy" method="post">
          {{ csrf_field() }}
          {{ method_field('delete') }}
          <div class="modal-body">
            <p>هل انت متاكد من عملية الحذف ؟</p><br>
            <input type="hidden" name="id" id="id" value="">
            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<script>
  $('#modaldemo2').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var product_name = button.data('product_name')
    var section_name = button.data('section_name')
    var product_description = button.data('product_description')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #product_name').val(product_name);
    modal.find('.modal-body #section_name').val(section_name);
    modal.find('.modal-body #product_description').val(product_description);
  })

  $('#modaldemo9').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var product_name = button.data('product_name')
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #product_name').val(product_name);
  })
</script>

@endsection
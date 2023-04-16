@extends('layouts.main')
@section('title', 'قائمة الاقسام')
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
			<h4 class="content-title mb-0 my-auto">قائمة الاقسام</h4>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">
		<div class="mb-3 mb-xl-0">
			<div class="btn-group dropdown">
        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">اضافة قسم</a>
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
								<th class="wd-15p border-bottom-0">اسم القسم</th>
								<th class="wd-20p border-bottom-0">الوصف</th>
								<th class="wd-15p border-bottom-0">العمليات</th>
							</tr>
						</thead>
						<tbody>
              <?php $i = 0 ?>
              @foreach ($sections as $section)
							<tr>
								<td> <?php $i++ ?> {{$i}} </td>
								<td>{{$section->section_name}}</td>
								<td>@if($section->section_description){{$section->section_description}}@else لم يتم العثور علي بيانات @endif</td>
								<td>								
                  <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-section_description="{{ $section->section_description }}" data-toggle="modal" href="#modaldemo2" title="تعديل"> <i class="fas fa-edit"></i> </a>
                  <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-toggle="modal" href="#modaldemo9" title="حذف"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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
          <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{route('sections.store')}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label>اسم القسم <span>*</span></label>
              <input type="text" name="section_name" class="form-control">
            </div>
            <div class="form-group">
              <label>الوصف</label>
              <input type="text" name="section_description" class="form-control">
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
          <h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="sections/update" method="post" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
              <input type="hidden" name="id" id="id" value="">
              <label>اسم القسم <span>*</span></label>
              <input type="text" name="section_name" id="section_name" class="form-control">
            </div>
            <div class="form-group">
              <label>الوصف</label>
              <input type="text" name="section_description" id="section_description" class="form-control">
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
          <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="sections/destroy" method="post">
          {{ csrf_field() }}
          {{ method_field('delete') }}
          <div class="modal-body">
            <p>هل انت متاكد من عملية الحذف ؟</p><br>
            <input type="hidden" name="id" id="id" value="">
            <input class="form-control" name="section_name" id="section_name" type="text" readonly>
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
    var section_name = button.data('section_name')
    var section_description = button.data('section_description')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #section_name').val(section_name);
    modal.find('.modal-body #section_description').val(section_description);
  })
  
  $('#modaldemo9').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var section_name = button.data('section_name')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #section_name').val(section_name);
  })
</script>
@endsection
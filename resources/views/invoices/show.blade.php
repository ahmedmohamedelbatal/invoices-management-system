@extends('layouts.main')
@section('title', 'تفاصيل الفاتورة')
@section('css')
<!---Internal  Prism css-->
<link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet" />
<!---Internal Input tags css-->
<link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet" />
<!--- Custom-scroll -->
<link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">تفاصيل الفاتورة</h4>
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
	@if(session()->has('edit'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
</div>
<!-- row opened -->
<div class="row row-sm">
  <div class="col-xl-12">
    <!-- div -->
    <div class="card mg-b-20" id="tabs-style2">
      <div class="card-body">
        <div class="text-wrap">
          <div class="example">
            <div class="panel panel-primary tabs-style-2">
              <div class="tab-menu-heading">
                <div class="tabs-menu1">
                  <!-- Tabs -->
                  <ul class="nav panel-tabs main-nav-line">
                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالة الدفع</a></li>
                    <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                    {{-- <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li> --}}
                  </ul>
                </div>
              </div>
              <div class="panel-body tabs-menu-body main-content-body-right border">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab4">
                    <div class="table-responsive mt-15">
                      <table class="table table-striped" style="text-align: center;">
                        <tbody>
                          <tr>
                            <th scope="row" style="white-space: nowrap;">رقم الفاتورة</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_number }}</td>
                            <th scope="row">تاريخ الاصدار</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_date }}</td>
                            <th scope="row">تاريخ الاستحقاق</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_due_date }}</td>
                            <th scope="row">القسم</th>
                            <td style="white-space: nowrap;">{{ $invoice->section->section_name }}</td>
                          </tr>

                          <tr>
                            <th scope="row">المنتج</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_product }}</td>
                            <th scope="row" style="white-space: nowrap;">مبلغ التحصيل</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_amount_collection }}</td>
                            <th scope="row">مبلغ العمولة</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_amount_commission }}</td>
                            <th scope="row">الخصم</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_discount }}</td>
                          </tr>

                          <tr>
                            <th scope="row" style="white-space: nowrap;">نسبة الضريبة</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_rate_vat }}</td>
                            <th scope="row">قيمة الضريبة</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_value_vat }}</td>
                            <th scope="row" style="white-space: nowrap;">الاجمالي مع الضريبة</th>
                            <td style="white-space: nowrap;">{{ $invoice->invoice_total }}</td>
                            <th scope="row" style="white-space: nowrap;">الحالة الحالية</th>
                            <td style="white-space: nowrap;">@if($invoice->invoice_status == 0) <span class="badge badge-pill badge-danger">غير مدفوعة</span> @else <span class="badge badge-pill badge-success">مدفوعة</span> @endif </td>
                          </tr>
                          <tr>
                            <th scope="row">ملاحظات</th>
                            <td style="white-space: nowrap;"> @if($invoice->invoice_note) {{ $invoice->invoice_note }} @else لم يتم العثور على بيانات @endif </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab5">
                    <div class="table-responsive mt-15">
                      <table class="table center-aligned-table mb-0 table-hover" style="text-align: center;">
                        <thead>
                          <tr class="text-dark">
                            <th>رقم الفاتورة</th>
                            <th>حالة الدفع</th>
                            <th>تاريخ الدفع</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="white-space: nowrap;">{{$invoice->invoice_number}}</td>
                            <td style="white-space: nowrap;">@if($invoice->invoice_status == 0) <span class="badge badge-pill badge-danger">غير مدفوعة</span> @else <span class="badge badge-pill badge-success">مدفوعة</span> @endif </td>
                            <td style="white-space: nowrap;">@if($invoice->payment_date) {{$invoice->payment_date}} @else 0000-00-00 @endif</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="pay-invoice" style="margin-top: 25px">
                      @if($invoice->invoice_status == '0')
                      <form action="{{route('pay-invoice', $invoice->id)}}" method="post">
                        @csrf
                        <div class="col-md-12">
                          <p class="text-danger">* يرجى ملاحظة عند تغيير حالة الدفع لا يمكن الرجوع</p>
                          <input class="btn btn-primary" type="submit" value="تغيير حالة الدفع">
                        </div>
                      </form>
                      @endif
                    </div>
                  </div>  

                  <div class="tab-pane" id="tab6">
                    <div class="table-responsive mt-15">
                      <table class="table center-aligned-table mb-0 table-hover" style="text-align: center;">
                        <thead>
                          <tr class="text-dark">
                            <th>رقم الفاتورة</th>
                            <th>اسم المرفق</th>
                            <th>عمليات</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="white-space: nowrap;">{{$invoice->invoice_number}}</td>
                            <td style="white-space: nowrap;">{{$invoice->invoice_attachment}}</td>
                            <td style="white-space: nowrap;">
                              <a class="btn btn-outline-success btn-sm" href="{{asset('files/'.$invoice->invoice_attachment)}}" target="_blank"><i class="fas fa-eye"></i>&nbsp; عرض</a>
                              <a class="btn btn-outline-info btn-sm" href="{{asset('files/'.$invoice->invoice_attachment)}}" download><i class="fas fa-download"></i>&nbsp; تحميل</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="card-body">
                      <form method="post" action="{{route('update-attachment')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <p class="text-danger">صيغة المرفق pdf, doc, docx, xlsx, pptx</p>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">المرفقات</span>
                            </div>
                            <div class="custom-file">
                              <input type="hidden" name="id" id="id" value="{{$invoice->id}}">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" name="invoice_attachment" aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="inputGroupFile01">اختيار ملف</label>
                            </div>
                          </div>  
                        </div>
                        <br />
                        <div class="d-flex">
                          <input type="submit" class="btn btn-primary" value="تعديل المرفق">
                        </div>
                      </form>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /div -->
  </div>
</div>
<!-- /row -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- Internal Input tags js-->
<script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
<!--- Tabs JS-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
<!--Internal  Clipboard js-->
<script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
<!-- Internal Prism js-->
<script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
@endsection
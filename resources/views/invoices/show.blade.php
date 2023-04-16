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
                    {{-- <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li> --}}
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
                            <td style="white-space: nowrap;"><span class="badge badge-pill badge-danger">{{ $invoice->invoice_status }}</span></td>
                          </tr>
                          <tr>
                            <th scope="row">ملاحظات</th>
                            <td style="white-space: nowrap;">
															@if($invoice->invoice_note) {{ $invoice->invoice_note }} @else لم يتم العثور على بيانات @endif
														</td>
                          </tr>
                        </tbody>
                      </table>
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
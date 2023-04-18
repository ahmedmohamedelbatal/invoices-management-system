@extends('layouts.main')
@section('title', 'اضافة فاتورة')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
  <div class="my-auto">
    <div class="d-flex">
      <h4 class="content-title mb-0 my-auto">اضافة فاتورة</h4>
    </div>
  </div>
</div>
<!-- breadcrumb -->

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          {{ csrf_field() }}
          <div class="row">
            <div class="col form-group">
              <label for="inputName" class="control-label">رقم الفاتورة <span>*</span></label>
              <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="inputName" name="invoice_number"/>
              @error('invoice_number') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col form-group">
              <label>تاريخ الفاتورة <span>*</span></label>
              <input class="form-control @error('Date') is-invalid @enderror" name="Date" type="date"/>
              @error('Date') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col form-group">
              <label>تاريخ الاستحقاق <span>*</span></label>
              <input class="form-control @error('Due_date') is-invalid @enderror" name="Due_date" type="date"/>
              @error('Due_date') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col form-group">
              <label>القسم <span>*</span></label>
              <select name="Section" class="form-control @error('Section') is-invalid @enderror">
                <option disabled selected value>--حدد القسم--</option>
                @foreach ($sections as $section)
                <option value="{{$section->id}}">{{$section->section_name}}</option>
                @endforeach
              </select>
              @error('Section') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col form-group">
              <label for="inputName" class="control-label">المنتج <span>*</span></label>
              <select id="product" name="product" class="form-control @error('product') is-invalid @enderror"></select>
              @error('product') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col form-group">
              <label for="inputName" class="control-label">مبلغ التحصيل <span>*</span></label>
              <input type="text" class="form-control @error('Amount_collection') is-invalid @enderror" id="inputName" name="Amount_collection" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
              @error('Amount_collection') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col form-group">
              <label for="inputName" class="control-label">مبلغ العمولة <span>*</span></label>
              <input type="text" 
                class="form-control form-control-lg @error('Amount_Commission') is-invalid @enderror" 
                id="Amount_Commission" 
                name="Amount_Commission" 
                title="يرجي ادخال مبلغ العمولة " 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
              />
              @error('Amount_Commission') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col">
              <label for="inputName" class="control-label">الخصم <span>*</span></label>
              <input type="text" 
                class="form-control form-control-lg @error('Discount') is-invalid @enderror" 
                id="Discount" 
                name="Discount"
                title="يرجي ادخال مبلغ الخصم "
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                value=0 
              />
              @error('Discount') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col form-group">
              <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة <span>*</span></label>
              <select name="Rate_VAT" id="Rate_VAT" class="form-control @error('Rate_VAT') is-invalid @enderror" onchange="myFunction()">
                <option value="" selected disabled>حدد نسبة الضريبة</option>
                <option value="5%">5%</option>
                <option value="14%">14%</option>
              </select>
              @error('Rate_VAT') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col form-group">
              <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة <span>*</span></label>
              <input type="text" class="form-control @error('Value_VAT') is-invalid @enderror" id="Value_VAT" name="Value_VAT" readonly>
              @error('Value_VAT') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>

            <div class="col form-group">
              <label for="inputName" class="control-label">الاجمالي شامل الضريبة <span>*</span></label>
              <input type="text" class="form-control @error('Total') is-invalid @enderror" id="Total" name="Total" readonly>
              @error('Total') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="row">
            <div class="col form-group">
              <label for="exampleTextarea">ملاحظات</label>
              <textarea class="form-control" id="exampleTextarea" name="note" rows="4"></textarea>
            </div>
          </div>
          <br />

          <div class="form-group">
            <p class="text-danger">صيغة المرفق pdf, doc, docx, xlsx, pptx</p>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">المرفقات</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('invoice_attachment') is-invalid @enderror" id="inputGroupFile01" name="invoice_attachment" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">اختيار ملف</label>
              </div>
            </div>  
            @error('invoice_attachment') <p style="color: #8991a5; font-size: 13px;">{{ $message }}</p> @enderror
          </div>

          <br />
          <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="حفظ البيانات">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
  <!-- Internal Select2 js-->
  <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
  <!--Internal Fileuploads js-->
  <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
  <!--Internal Fancy uploader js-->
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
  <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
  <!--Internal  Form-elements js-->
  <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
  <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
  <!--Internal Sumoselect js-->
  <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
  <!--Internal  Datepicker js -->
  <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
  <!--Internal  jquery.maskedinput js -->
  <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
  <!--Internal  spectrum-colorpicker js -->
  <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
  <!-- Internal form-elements js -->
  <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('select[name="Section"]').on('change', function() {
        var SectionId = $(this).val();
        if (SectionId) {
          $.ajax({
            url: "{{ URL::to('section') }}/" + SectionId,
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('select[name="product"]').empty();
              $.each(data, function(key, value) {
                $('select[name="product"]').append('<option value="' + value + '">' + value + '</option>');
              });
            },
          });
        } else {
          console.log('AJAX load did not work');
        }
      });
    });

    function myFunction() {
      var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
      var Discount = parseFloat(document.getElementById("Discount").value);
      var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
      var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
      var Amount_Commission2 = Amount_Commission - Discount;

      if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
        alert('يرجي ادخال مبلغ العمولة ');
      } else {
        var intResults = Amount_Commission2 * Rate_VAT / 100;
        var intResults2 = parseFloat(intResults + Amount_Commission2);
        sumq = parseFloat(intResults).toFixed(2);
        sumt = parseFloat(intResults2).toFixed(2);
        document.getElementById("Value_VAT").value = sumq;
        document.getElementById("Total").value = sumt;
      }
    }
  </script>
@endsection

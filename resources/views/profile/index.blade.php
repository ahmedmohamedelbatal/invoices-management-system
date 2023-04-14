@extends('layouts.main')
@section('title', 'معلومات الحساب')
@section('content')
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">معلومات الحساب</h4>
		</div>
	</div>
</div>
<div class="alerts-section">
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger fade show" role="alert"> {{ $error }} </div>
    @endforeach
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
  <div class="col-lg-4">
    <div class="card mg-b-20">
      <div class="card-body">
        <div class="pl-0">
          <div class="main-profile-overview">
            <div class="main-img-user profile-user">
              @if ($user->image)
              <img alt="" src="{{URL::asset('files/'.$user->image)}}">
              @else
              <img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}">
              @endif
            </div>
            <div class="d-flex justify-content-between mg-b-20">
              <div>
                <h5 class="main-profile-name">{{$user->name}}</h5>
                <p class="main-profile-name-text">{{$user->email}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <div class="tabs-menu ">
          <!-- Tabs -->
          <ul class="nav nav-tabs profile navtab-custom panel-tabs">
            <li class="">
              <a href="#profile" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">معلومات الحساب</span> </a>
            </li>
            <li class="">
              <a href="#change_password" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">تغيير كلمة المرور</span> </a>
            </li>
          </ul>
        </div>
        <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
          <div class="tab-pane active" id="profile">
            <form role="form" method="post" action="{{route('update-profile')}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="FullName">الاسم الكامل <span>*</span></label>
                <input type="text" name="name" value="{{$user->name}}" id="FullName" class="form-control @error('name') is-invalid @enderror">
              </div>
              <div class="form-group">
                <label for="Email">البريد الالكترونى <span>*</span></label>
                <input type="email" name="email" value="{{$user->email}}" id="Email" class="form-control @error('email') is-invalid @enderror">
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">صورة شخصية</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">اختيار ملف</label>
                  </div>
                </div> 
              </div> 
              <input class="btn btn-primary waves-effect waves-light w-md" type="submit" value="حفظ">
            </form>
          </div>
          
          <div class="tab-pane" id="change_password">
            <form role="form" action="{{route('change_password')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="current_password">كلمة المرور الحالية <span>*</span></label>
                <input type="password" placeholder="ادخل كلمة المرور الحالية" name="current_password" required autocomplete="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror">
              </div>
              <div class="form-group">
                <label for="Password">كلمة المرور الجديدة <span>*</span></label>
                <input type="password" placeholder="ادخل كلمة المرور الجديدة" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              </div>
              <div class="form-group">
                <label for="RePassword">اعادة ادخال كلمة المرور <span>*</span></label>
                <input type="password" placeholder="اعادة ادخال كلمة المرور" name="password_confirmation" id="password-confirm" class="form-control" required>
              </div>
              
              <input class="btn btn-primary waves-effect waves-light w-md" type="submit" value="حفظ">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.registration')
@section('title', 'التسجيل')
@section('css')
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
	<div class="row no-gutter">
		<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
			<div class="row wd-100p mx-auto text-center">
				<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
					<img src="{{URL::asset('assets/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
			<div class="login d-flex align-items-center py-2">
				<div class="container p-0">
					<div class="row">
						<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
							<div class="card-sigin">
								<div class="main-signup-header">
									<h2 class="text-primary">ابدأ الان!</h2>
									<h5 class="font-weight mb-4">التسجيل مجاني ولا يستغرق سوى دقيقة واحدة.</h5>
									<form method="post" action="{{ route('register') }}">
										@csrf
										<div class="form-group">
											<label>الاسم الكامل</label> 												
											<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="ادخل اسمك الكامل" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
											@error('name') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
										</div>
										<div class="form-group">
											<label>عنوان البريد الإلكتروني</label> 												
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="ادخل البريد الإلكتروني" name="email" value="{{ old('email') }}" required autocomplete="email">
											@error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
										</div>
										<div class="form-group">
											<label>كلمة المرور</label> 
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="ادخل كلمة المرور" name="password" required autocomplete="new-password">
											@error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
										</div>
										<div class="form-group">
											<label>تأكيد كلمة المرور</label> 
											<input id="password-confirm" type="password" class="form-control" placeholder="اعادة ادخال كلمة المرور" name="password_confirmation" required autocomplete="new-password">
										</div>

										<input type="submit" class="btn btn-main-primary btn-block" value="انشاء حساب"> 
									</form>
									<div class="main-signup-footer mt-5">
										<p>هل لديك حساب ؟ <a href="{{ url('/' . $page='login') }}">تسجيل الدخول</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
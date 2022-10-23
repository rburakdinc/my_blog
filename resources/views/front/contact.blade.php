@extends('front.layouts.master')
@section('title','İletişim')
@section('content')

    <div class="col-md-9 mx-auto">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 mx-auto  ">
                @if(session('success'))
                <div class="alert alert-success">
                   {{session('success')}}
                </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                <p>Bu sayfada bizimle iletişime geçebilirsiniz.</p>
                <div class="my-5">
                    <form method="post" action="{{route('contact.post')}}" >
                        @csrf
                        <div class="form-floating">
                            <input class="form-control" name="name" type="text" value="{{old('name')}}" placeholder="Adınızı ve Soyadınızı yazınız..." data-sb-validations="required" />
                            <label for="name">Ad Soyad</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">Bir isim gerekli!</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="email" type="email" value="{{old('email')}}" placeholder="E-Mailinizi yazınız..." data-sb-validations="required,email" />
                            <label for="email">E-mail adresi</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">Bir e-mail gerekli!</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">E-mail geçerli</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="phone" type="tel" value="{{old('phone')}}" placeholder="Telefon numaranızı yazınız..." data-sb-validations="required" />
                            <label for="phone">Telefon numarası</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">Bir telefon numarası gerekli.</div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="message"  value="{{old('message')}}" placeholder="Mesajınızı buraya yazınız..." style="height: 12rem" data-sb-validations="required"></textarea>
                            <label for="message">Mesaj</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">Mesaj girilmesi zorunludur!</div>
                        </div>
                        <br />
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form kaydı başarılı</div>
                                Bu formu aktifleştirmek için giriş yapınız...
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>

                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Hata!</div></div>

                        <button class="btn btn-outline-success text-uppercase" id="submitButton" type="submit">Gönder</button>
                    </form>
                </div>
@endsection

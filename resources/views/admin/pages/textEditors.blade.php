@extends('./admin/component/mainPage')
@section('content')
    @if (session('access'))
    <div class='alert alert-danger'><strong></strong>   الدخول غير مسموح </div>
    @endif
    <section class="content-header">
        <h1>
        تعديل الصفحات
        <small> </small>
        </h1>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-4 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <p> تعديل النص العربي</p>
                        <hr>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="/pages/ar" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <p> تعديل النص الانجليزي</p>
                        <hr>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="/pages/en" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <p> تعديل  بيانات الاتصال</p>
                        <hr>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="/contact/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div><!-- ./col -->
        </div>


@endsection

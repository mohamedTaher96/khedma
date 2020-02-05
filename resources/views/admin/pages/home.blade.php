@extends('./admin/component/mainPage')
@section('content')
    @if (session('access'))
    <div class='alert alert-danger'><strong></strong>   الدخول غير مسموح </div>
    @endif
    <section class="content-header">
        <h1>
        الرئيسيه
        <small> </small>
        </h1>
    </section>

<!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-sm-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <p> تعديل  الصفحات</p>
                    <hr>
                </div>
                <div class="icon">
                    <i class=""></i>
                </div>
                <a href="/pages/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <p>   الفنين</p>
                    <hr>
                </div>
                <div class="icon">
                    <i class=""></i>
                </div>
                <a href="/workers/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <p>   الخدمات</p>
                    <hr>
                </div>
                <div class="icon">
                    <i class=""></i>
                </div>
                <a href="/services/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div><!-- ./col -->

    </div>


@endsection

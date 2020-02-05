@extends('./admin/component/mainPage')
@section('content')
    @if (session('error'))
    <div class='alert alert-danger'> جميع البيانات مطلوبه ونوع الملف يجب ان يكون صوره</div>
    @endif
    <section class="content-header">
            <h1> بيانات الاتصال</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
                    <!-- form start -->
            <form action="new/add" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> رقم الهاتف </label>
                        <input type="number" class="form-control" name="number" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">  الواتس</label>
                        <input type="number" class="form-control" name="watsapp" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"> البريد الالكتروني  </label>
                        <input type="email" class="form-control"  name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"> روابط السوشيال ميديا  </label>
                        <div>
                            
                            <input type="email" class="form-control"  name="email">
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                </div>
            </form>
        </div>
    </section>
@endsection

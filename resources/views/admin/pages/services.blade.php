
@extends('./admin/component/mainPage')
@section('content')
    @if (session('add'))
        <div class='alert alert-success'><strong></strong>  تم إضافة العميل بنجاح. </div>
    @endif
    @if (session('delete'))
        <div class='alert alert-success'><strong></strong>  تم حذف العميل بنجاح. </div>
    @endif
    @if (session('edit'))
        <div class='alert alert-success'><strong></strong>  تم تعديل العميل بنجاح. </div>
    @endif
    <section class="content-header">
            <h1>  الفنين </h1>
            <br>
    </section>
    <section class="">
        <div class="box">
                <div class="box-header">
                  <a href="/service/new/" role="button" class="btn btn-primary" >إضافة خدمة</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>  الاسم</th>
                        <th> الصورة</th>
                        <th> الخدمات الفرعية</th>
                        <th> تعديل/مسح</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>  {{$item->name}}</td>
                            <td>  {{$item->image}}</td>
                            <th>  <a href="sub/{{$item->id}}">الخدمات</a></th>
                            <td>
                                <a href="edit/{{$item->id}}" role="button" class="btn btn-primary ">تعديل</a>
                                <a href="delete/{{$item->id}}" role="button" class="btn btn-danger" onclick="return confirm('هل انت متاكد؟')">مسح</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>  الاسم</th>
                        <th>الصورة </th>
                        <th> الخدمات الفرعية</th>
                        <th> تعديل/مسح</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
        </div>
</section>

@endsection
@section('script')
        <!-- DataTables -->
        <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
        <script>
            $("#example1").DataTable();
            if($(".alert"))
            {
                window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove();
                        });
                    }, 1000);
            }
        </script>
@endsection

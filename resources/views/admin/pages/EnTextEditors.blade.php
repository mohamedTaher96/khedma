@extends('./admin/component/mainPage')
@section('content')
    <section id="alert">
        @if (session('edit'))
        <div class='alert alert-success'><strong></strong>  تم تعديل النص بنجاح. </div>
        @endif
    </section>
    <section class="content-header">
        <h1> صفحة</h1>
    </section>
      <!-- Main content -->
    <section class="content">
        <div  class="form-group">
            <label for="sel1"> تعديل النص :</label>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="box" style="text-align:center;color:blue" >
                    <h4>تعديل نص عننا</h4>
                    <div id="editor" class="box-body pad">
                        <form action="en/about/update" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <textarea class="form-control" id="editor1" name="about" rows="10" cols="80">
                                {!!$aboutContent!!}
                            </textarea>
                            <hr>
                            <input type="hidden" name="id" value="">
                            <input type="submit" class="btn btn-primary" value="تعديل" id="edit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="box" style="text-align:center;color:blue">
                    <h4>تعديل نص سياسة الاستخدام</h4>
                    <div id="editor" class="box-body pad">
                        <form action="en/policy/update" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <textarea class="form-control" id="editor2" name="policy" rows="10" cols="80">
                                {!!$policyContent!!}
                            </textarea>
                            <hr>
                            <input type="hidden" name="id" value="">
                            <input type="submit" class="btn btn-primary" value="تعديل" id="edit">
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
@section('script')

    <script>
        CKEDITOR.replace( 'about' );
        CKEDITOR.replace( 'policy' );
        CKEDITOR.replace( 'editor3' );
        // CKEDITOR.replace('content');
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

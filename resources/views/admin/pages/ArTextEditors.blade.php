@extends('./admin/component/mainPage')
@section('content')
    <section id="alert">
        @if (session('edit'))
        <div class='alert alert-success'><strong></strong>  تم تعديل النص بنجاح. </div>
        @endif
    </section>
    <section class="content-header">

        <h1>
            صفحة
            <small> </small>
        </h1>
    </section>
      <!-- Main content -->
    <section class="content">
        <div  class="form-group">
            <label for="sel1"> تعديل النص :</label>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="box" style="text-align:center;color:blue" >
                    <h4>تعديل نص 1</h4>
                    <div id="editor" class="box-body pad">
                        <form action="update" method="post">
                            <textarea class="form-control" id="editor1" name="editor1" rows="10" cols="80">

                                {{-- {!!$pageArContent->content!!} --}}
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
                    <h4>تعديل نص 2</h4>
                    <div id="editor" class="box-body pad">
                        <form action="update" method="post">
                            <textarea class="form-control" id="editor2" name="editor2" rows="10" cols="80">

                                {{-- {!!$pageArContent->content!!} --}}
                            </textarea>
                            <hr>
                            <input type="hidden" name="id" value="">
                            <input type="submit" class="btn btn-primary" value="تعديل" id="edit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-right:30%">
            <div class="col-xs-8">
                <div class="box" style="text-align:center;color:blue" >
                    <h4>تعديل سياسة المستخدم</h4>
                    <div id="editor" class="box-body pad">
                        <form action="update" method="post">
                            <textarea class="form-control" id="editor3" name="editor3" rows="10" cols="80">

                                {{-- {!!$pageArContent->content!!} --}}
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
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
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

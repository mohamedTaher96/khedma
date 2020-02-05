
@extends('./admin/component/mainPage')
@section('content')
    @if (session('add'))
    <div class='alert alert-success'> تمت اضافة الخدمة بنجاح</div>
    @endif
    @if (session('error'))
    <div class='alert alert-danger'> جميع البيانات مطلوبه ونوع الملف يجب ان يكون صوره</div>
    @endif
    <section class="content-header">
            <h1> إضافة خدمة </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title">خدمة جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="add" method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> اسم الخدمة</label>
                            <input type="text" class="form-control" name="name" placeholder=" ">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputFile">صورة الخدمة  </label>
                            <input type="file"  name="image">
                        </div>

                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">إضافة</button>
                      </div>
                    </form>
                  </div>
    </section>
    @section('script')
        <script>
            $('select').multipleSelect()
            $('#map').click(function(x){
                console.log(x);
            })
            directions=[];
            function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: {lat: -25.363882, lng: 131.044922 }
            });

            map.addListener('click', function(e) {
                console.log(e.latLng)
                placeMarkerAndPanTo(e.latLng, map);
            });
            }

            function placeMarkerAndPanTo(latLng, map) {
                directions.push(latLng);
                $('#directions').attr('value',directions);
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            map.panTo(latLng);
            }
            if($(".alert"))
            {
                window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove();
                        });
                    }, 1000);
            }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4D4HY5_K2K9wn3E2nnZXdeic46RN0-io&callback=initMap"></script>
    @endsection
@endsection

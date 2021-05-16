@extends('theme.default')

@section('content')
<!-- row -->

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/user/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Details</a></li>
        </ol>
    </div>
</div>
<!-- row -->
<div class="container-fluid">
    <!-- End Row -->
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="card category-card">
                <div class="card-body">
                    <h4>Product Name</h4>
                    <p class="text-muted">{{$productdetails->product_name}}</p>

                    <h4>Description</h4>
                    <p class="text-muted">{{$productdetails->product_description}}</p>
                </div>
            </div>  
        </div>
        <div class="col-lg-8 col-xl-9">
            <div id="success-msg" class="alert alert-dismissible mt-3" style="display: none;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Message!</strong> <span id="msg"></span>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddProduct" data-whatever="@addProduct">Add Product images Or PDF</button>
            <div id="card-display">
                @include('user_tables.productimage')
            </div>
        </div>
    </div>
    <!-- End Row -->

    <!-- Edit Images -->
    <div class="modal fade" id="EditImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" name="editimg" class="editimg" id="editimg" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabeledit">Product Image Or PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <span id="emsg"></span>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Image Or PDF</label>
                            <input type="hidden" id="idd" name="id">
                            <input type="hidden" class="form-control" id="old_img" name="old_img">
                            <input type="file" class="form-control" name="image" id="image" accept=".png, .jpg, .jpeg, .pdf">
                            <input type="hidden" name="removeimg" id="removeimg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btna-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Item Image -->
    <div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" name="addproduct" class="addproduct" id="addproduct" enctype="multipart/form-data">
                <span id="msg"></span>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product Image Or PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <span id="iiemsg"></span>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="colour" class="col-form-label">Select Product images or PDF:</label>
                            <input type="file" multiple="true" class="form-control" name="file[]" id="file" accept=".png, .jpg, .jpeg, .pdf" required>
                        </div>
                        <div class="gallery"></div>

                        <input type="hidden" name="itemid" id="itemid" value="{{request()->route('id')}}">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #/ container -->

<!-- #/ container -->
@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {

        $('#addproduct').on('submit', functi on(event){
            event.preventDefault();
            var form_data = new FormData(this);
            form_data.append('file',$('#file')[0].files);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ URL::to('user/product/storeimages') }}",
                method:"POST",
                data:form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(result) {
                    var msg = '';
                    $('div.gallery').html('');  
                        msg += '<div class="alert alert-success mt-1">'+result.success+'</div>';
                        $('#message').html(msg);
                        $("#AddProduct").modal('hide');
                        $("#addproduct")[0].reset();
                        location.reload();
                },
            })
        });

        $('#editimg').on('submit', function(event){
            event.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                url:"{{ URL::to('user/product/updateimage') }}",
                method:'POST',
                data:form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(result) {
                    var msg = '';
                    if(result.error.length > 0)
                    {
                        for(var count = 0; count < result.error.length; count++)
                        {
                            msg += '<div class="alert alert-danger">'+result.error[count]+'</div>';
                        }
                        $('#emsg').html(msg);
                        setTimeout(function(){
                          $('#emsg').html('');
                        }, 5000);
                    }
                    else
                    {
                        location.reload();
                    }
                },
            });
        });
    });

    function EditDocument(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ URL::to('user/product/showimage') }}",
            data: {
                id: id
            },
            method: 'POST', //Post method,
            dataType: 'json',
            success: function(response) {
                jQuery("#EditImages").modal('show');
                $('#idd').val(response.ResponseData.id);
                $('.galleryim').html("<img src="+response.ResponseData.img+" class='img-fluid' style='max-height: 200px;'>");
                $('#old_img').val(response.ResponseData.image);
            },
            error: function(error) {

                // $('#errormsg').show();
            }
        })
    }


    function DeleteImage(id) {
        // dd(id);
        swal({
            title: "Are you sure?",
            text: "Do you want to delete this image?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true,
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ URL::to('user/product/destroyimage') }}",
                    data: {
                        id: id
                    },
                    method: 'POST',
                    success: function(response) {
                        if (response == 1) {
                            swal({
                                title: "Approved!",
                                text: "Image has been deleted.",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Ok",
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    swal.close();
                                    location.reload();
                                }
                            });
                        } else {
                            swal("Cancelled", "Something Went Wrong :(", "error");
                        }
                    },
                    error: function(e) {
                        swal("Cancelled", "Something Went Wrong :(", "error");
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        });
    }


     $(document).ready(function() {
         var imagesPreview = function(input, placeToInsertImagePreview) {
              if (input.files) {
                  var filesAmount = input.files.length;
                  $('div.gallery').html('');
                  var n=0;
                  for (i = 0; i < filesAmount; i++) {
                      var reader = new FileReader();
                      reader.onload = function(event) {
                           $($.parseHTML('<div>')).attr('class', 'imgdiv').attr('id','img_'+n).html('<img src="'+event.target.result+'" class="img-fluid"><span id="remove_"'+n+' onclick="removeimg('+n+')">&#x2716;</span>').appendTo(placeToInsertImagePreview); 
                          n++;
                      }
                      reader.readAsDataURL(input.files[i]);                                  
                 }
              }
          };

         $('#file').on('change', function() {
             imagesPreview(this, 'div.gallery');
         });
     
    });
    var images = [];
    function removeimg(id){
        images.push(id);
        $("#img_"+id).remove();
        $('#remove_'+id).remove();
        $('#removeimg').val(images.join(","));
    }
</script>
@endsection
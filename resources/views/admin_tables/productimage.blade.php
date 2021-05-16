<div class="row" style="margin-top: 5px;">

<?php
// dd($getproductimages);
foreach ($getproductimages as $itemimage) {

?>
<div class="col-md-6 col-lg-7 dataid{{$itemimage->id}}" id="table-image">
    <div class="card">
    <?php 
        if(strpos($itemimage->image,"pdf")){?>
            <object data='{{ URL::asset("data/product/".$itemimage->image) }}' type="application/pdf" style="max-height: 255px; min-height: 255px;">
                <p>Alternative text - include a link <a href='{{ URL::asset("data/product/".$itemimage->image) }}'>to the PDF!</a></p>
            </object>
        <?php
             
        }else{?>
            <img class="img-fluid" src='{{ URL::asset("data/product/".$itemimage->image) }}' style="max-height: 255px; min-height: 255px;" >
        <?php
        }?>
   
        <!-- <img class="img-fluid" src='{{ URL::asset("data/product/".$itemimage->image) }}' style="max-height: 255px; min-height: 255px;" > -->
        <div class="card-body">
            <button type="button" onclick="DeleteImage('{{$itemimage->id}}')" class="btn mb-2 btn-sm btn-danger">Delete</button>
        </div>
    </div>
</div>
<?php
}
?>
</div>
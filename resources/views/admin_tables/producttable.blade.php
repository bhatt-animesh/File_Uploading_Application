<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getproduct as $item) {
            // print_r($item);
        ?>
        <tr id="dataid{{$item->id}}">
            <td>{{$item->id}}</td>
            <td>{{$item->product_name}}</td>
            <td>{{$item->product_description}}</td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('{{$item->id}}')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    <a data-toggle="tooltip" href="{{URL::to('admin/product-images/'.$item->id)}}" data-original-title="View">
                        <span class="badge badge-warning">View</span>
                    </a>
                    <a class="badge badge-danger px-2" onclick="StatusUpdate('{{$item->id}}','2')" style="color: #fff;">Delete</a>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
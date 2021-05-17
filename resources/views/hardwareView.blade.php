@extends('layouts.app', ['page' => __('View Process'), 'pageSlug' => 'recruitprocess.view'])
@section('content')
@push('pageSpecificCSS')
   <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <style>
      .modal-dialog {
        margin: -25vh auto 0px auto;
        }
       
            .card-footer
            {
                background-color: rgb(18, 30, 61);
            }
            .modal-content .modal-body p
            {
                color: white;
            }
            label
            {
                color: grey;
            }
            td,th {
                text-align: center;
                vertical-align: middle;
            }

     </style>
@endpush
<div id="viewBody">
    <div style="background-color: rgb(18, 30, 61)">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table data-toggle="table" id="table" class="table table-striped table-dark">
           <thead>
            <th style="color: white;" >Item Name</th>
            <th style="color: white;" >Company</th>
            <th style="color: white;">Price</th>
            <th style="color: white;" >Status</th>
            <th style="color: white;">Action</th>
           </thead>
           <tbody>
            @foreach ($datas->reverse() as $data)
                        <tr id="rid{{ $data->id }}">

                            <td>{{ $data->itemname }}</td>
                            <td>{{ $data->company }}</td>
                            <td>{{ $data->price }}</td>
                            @if ($data->haveornot)
                                <td>In the Stock</td>
                            @else
                                <td>Out of Stock</td>
                            @endif
                            <td>
                                <a href="javascript:void(0)" class="btn btn-primary announce" data-toggle="modal" data-id="{{ $data->id }}" >Delete</a>
                              <br/><br/>
                                <a href="javascript:void(0)" onclick="editItem({{ $data->id }})" class="btn btn-info">Update</a>
                            </td>
                        </tr>
            @endforeach
           </tbody>


          </table>
    </div>
</div>
<!-- modal start -->
<div class="modal fade" id="recruitmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content" style="background-color: rgb(18, 30, 61);margin-top: 20%;">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="color: white;">Update Item</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="recruitmentEditForm" >
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="pname">Item Name</label>
                        <input type="text" class="form-control" name="itemname" id="itemname" >
                    </div>

                    <div class="form-group">
                        <label for="contacts">Company</label>
                        <input type="text" class="form-control" name="company" id="company">
                    </div>
                    <div class="form-group">
                        <label for="year">Price</label>
                        <input type="text" class="form-control" name="price" id="price">
                    </div>
                   
                    <div class="form-group">
                        <label>Status</label>
                            <select name="process_status" class="form-control" id="status" >
                            <option value="1" style="color: black;">In the Stock</option>
                            <option value="0"  style="color: black;">Out of Stock</option>
                            </select>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <span id="error-message" class="test-danger"></span>
                    <span id="success_message" class="test-success"></span>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal for delete -->
<div class="modal fade" id="recruitmentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle">Are You Sure?</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 style="color: #27293d;">Do you really want to delete this Recruit Process?</h5>
            <form>
                <input type="hidden" name="recID" id="recID" />
                <fieldset>

                    <div class="control-group">
                        <div class="controls">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="deleteItem(document.getElementById('recID').value)">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

      </div>
    </div>
  </div>

<!-- modal end-->

    @push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <script src="{{asset('js/alert-box.js')}}"></script>
        <script>
            function editItem(id){
                console.log("edit recruitment");
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('item.get')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        :{
                                    _token:$('meta[name="csrf-token"]').attr('content'),
                                    id:id,
                                    },
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        $("#id").val(response.data.id);
                        $("#itemname").val(response.data.itemname);
                        $("#company").val(response.data.company);
                        $("#price").val(response.data.price);
                        $("#status").val(response.data.haveornot);
                        $("#recruitmentEditModal").modal('toggle');
                    }else if(response.status=='204'){
                        
                    }
                });
            }
            $('#recruitmentEditForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('item.update')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        : formData,
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        
                    }else if(response.status=='422'){
                        
                        $.each(response.error, function( key, value ) {
                            
                        });
                    }else{
                        
                    }
                    $('#recruitmentEditForm').each(function(){
                        this.reset();
                    });
                }).fail(function(response) {
                    console.error(response);
                });
                location.reload("#table");
                //$('#table').trigger("reset");
                $("#recruitmentEditModal").modal('toggle');
            });


            $(document).ready(function(){ //  function for show delete modal and pass id to the modal
                $(".announce").click(function(){ // Click to only happen on announce links
                    $("#recID").val($(this).data('id'));
                    console.log($(this).data('id'));
                    $('#recruitmentDeleteModal').modal('show');
                });
            });

            function deleteItem(id){
                    $.ajax({
                        url:'{{route('item.delete')}}',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'DELETE',
                        dataType:'json',
                        data:{
                            _token:$('meta[name="csrf-token"]').attr('content'),
                            id:id,
                        },
                        success:function(response){
                            if(response.status == '200'){
                                
                                $('#rid'+response.data.id).remove();
                            }else{
                                
                            }
                        },
                    })
            }
        </script>
    @endpush
    @endsection

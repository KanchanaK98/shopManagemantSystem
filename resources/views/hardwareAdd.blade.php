
    @extends('layouts.app', ['page' => __('Add Items'), 'pageSlug' => 'view.add'])
    @section('content')
        @push('pageSpecificCSS')

		<style>
           
            label
            {
                color: grey;
            }

        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        @endpush
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Add Items to Stock') }}</h5>
                    </div>

                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                    @endforeach
                   
                    <form method="POST" action="{{ route('addprocess') }}">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div >
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="itemname" >
                        </div>
                        <div>
                            <label>Company</label>
                            <input type="text" class="form-control" name="company">

                        </div>
                        <div>
                            <label>Price</label>
                            <input type="text" class="form-control" name="price">

                        </div>
                        
                        <div >
                            <label>Status</label>
                            <select name="process_status" class="form-control" >
                            <option value="1" style="color: black;">In the Stock</option>
                            <option value="0"  style="color: black;">Out of Stock</option>
                            </select>
                        </div>

                       
                        
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-fill btn-primary" value="Add Item">
                    </div>
                    </form>
                    <br/>
                    <br/>
            </div>


        </div>
    </div>
        
    @endsection



@extends('visitors.layout')
 
@section('content')

<div id='jumbotron'>
        @csrf
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>List View</h2>
                </div>
                <div class="pull-right">
                    <input type="button"  class="btn btn-success" value="Back"  id="btn_back" />
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Select Temperature</label>
            <select id="ddl_temperature" name="temperature" >
                <option value="less_37.5"><37.5</option>
                <option value="greater_37.5">>37.5</option>
            </select>
        </div>
        <div class="form-group row" id="show_data">
            <table id="show_tbl" class="table table-bordered" width="100%" >
                <thead>
                    <tr>      
                        <th>No</th>
                        <th>Name</th>
                        <th>Date Time</th>
                        <th>Temperature</th>
                        <th>Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors_normaltemp as $visitor)            
                        <tr>
                            <td>{{ $visitor->id }}</td>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->date }}</td>
                            <td>{{ $visitor->temperature }}</td>           
                            <td>{{ $visitor->contact_number }}</td>
                        </tr>            
                    @endforeach                
                </tbody>
            </table>
        </div>
</div>
    <script>
       $(document).ready(function() {
        $('#show_tbl').DataTable();

        // back to visitor creation page
        $( "#btn_back" ).click(function() {
            $.ajax({
                type: "get",
                url: '/visitors/clear_session', 
            }).done(function( value ) {
                window.location.href = "{{URL::to('/visitors/create')}}";
            });
        });

        // temperature dropdown trigger event
        $( "#ddl_temperature" ).change(function() {
            $('#show_tbl').html();
                        
            var temperature =  $( "#ddl_temperature option:selected" ).val();
            $.ajax({
                type: "GET",
                url: '/visitors/show_data', 
                data: { temperature:temperature}, 
            }).done(function( result ) {
                var res='<table id="show_tbl" class="table table-bordered" width="100%"><thead><tr><th>No</th><th>Name</th><th>Date Time</th><th>Temperature</th><th>Contact Number</th></tr></thead><tbody>';
                $.each (result, function (key, value) {
                        res +=
                        '<tr>'+
                            '<td>'+value.id+'</td>'+
                            '<td>'+value.name+'</td>'+
                            '<td>'+value.date+'</td>'+
                            '<td>'+value.temperature+'</td>'+
                            '<td>'+value.contact_number+'</td>'+
                    '</tr>';                    
                });
                res +='</tbody></table>';
                $('#show_tbl').html(res);
                $('#show_tbl').DataTable({ 
                    "destroy": true, //reinitialize datatable
                });
                
            });
        });
    });        
                
    </script>
    
@endsection
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
    

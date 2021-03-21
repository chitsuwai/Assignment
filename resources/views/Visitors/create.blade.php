@extends('Visitors.layout')

@section('content')
<div id='jumbotron'>
    <div class="row">
        <div class="pull-center">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="pull-left">
            <h2>Create a New Visitor</h2>
        </div>
        <div class="pull-right">
            <input type="button"  class="btn btn-success" value="Admin"  data-toggle="modal" data-target="#myModal" />
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <form action="{{ route('visitors.store') }}" method="POST">
            @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="alert alert-danger" style="display:none"></div>
                    <input type="text" name="name" class="form-control " placeholder="Name">
                </div>
                <div class="form-group row">
                    <label for="contactnumber" class="col-sm-2 col-form-label">Contact Number</label>
                        <div class="alert alert-danger" style="display:none"></div>
                        <input type="tel" oninput="check(this)" name="contact_number" class="form-control" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" title="Format: 123-45-678">
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="alert alert-danger" style="display:none"></div>
                    <input type="text" name="date" id="date" class="form-control" placeholder="Date" />
                    <input type="button" class="btn btn-default" id="btn_date" value="Set Date" />
                </div>
                <div class="form-group row">
                    <label for="temperature" class="col-sm-2 col-form-label">Temperature</label>
                    <div class="alert alert-danger" style="display:none"></div>
                    <input type="number" step="00.01" max="99.99"  name="temperature" class="form-control" placeholder="Temperature" id="temperature" pattern="^\d{0,2}(\.\d{1,2})?$"/>
                </div>
                <div class="form-group row">
                    <label for="Safe" class="col-sm-2 col-form-label">Safe</label><br/>
                    <div class="alert alert-light" style="width:50px;height:50px;background-color:#fff;" name="safe" id="safe"></div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-success" id="btn_create">Create</button>
                </div>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Enter Password</h4>
                            </div>
                            <div class="modal-body">
                            <input id="password" type="password"/>
                            </div>
                            <div class="modal-footer">
                            <!-- <button type="button" formnovalidate="formnovalidate" name="cancel" class="cancel" id="btn_login">Login</button>  -->
                            <input type="button" class="btn btn-success" value="Login" id="btn_login" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</div>
<style>
#login_popup {
    width:160px;
    height:80px;
    padding:20px;
    background-color:gray;    
    position:absolute;
    top:100px;
    left:100px;
    display:none;
}
.orange{
    color:orange;
}
.green{
    color:green;
}
.red{
    color:red;
}
</style>
<script>
        $(document).ready(function(){
            //prevent entering data in date text field
            $('#date').keypress(function(event) {
                event.preventDefault();
            });

            //set default date
            $('#btn_date').click(function(e){
                var today = new Date();
                var day = today.getDate() + "";
                var month = (today.getMonth() + 1) + "";
                var year = today.getFullYear() + "";
                var hour = today.getHours() + "";
                var minutes = today.getMinutes() + "";
                var seconds = today.getSeconds() + "";
                day = checkZero(day);
                month = checkZero(month);
                year = checkZero(year);
                hour = checkZero(hour);
                minutes = checkZero(minutes);
                seconds = checkZero(seconds);
                current_datetime = year + "-" + month + "-" + day + " " + hour + ":" + minutes + ":" + seconds;
                $("#date").val(current_datetime);
            });
            //show color box
            $( "#temperature" ).keyup(function() {
                var temp = $(this).val();
                var default_temp= 37.5;
                if(temp>=default_temp){
                    $("#safe").css({"background-color":"red"});
                }
                else{
                    $("#safe").css({"background-color":"green"});
                }
            });

            //redirect to visitiors listing
            $('#btn_login').click(function(e){
               // e.preventDefault();
                var input_password = $("#password").val();
                var default_password = '123456';
                if(default_password == input_password){
                    $.ajax({
                        type: "get",
                        url: '/visitors/set_session', 
                        data: { default_password:default_password}, 
                    }).done(function( value ) {
                        window.location.href = "{{URL::to('/visitors')}}";
                    });
                }
                else{
                    alert("You are not allowed to login");
                    e.preventDefault();
                }

            });
        });

        //date format
        function checkZero(data){
            if(data.length == 1){
                data = "0" + data;
            }
            return data;
        }

        //login popup
        function showPopup() {
            $("#modal-content").css({ display: "block" });
        }
</script>
@endsection
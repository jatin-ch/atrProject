@extends('layouts.admin')
@section('title') | Permissions | Create @endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Create New Permission
                </div>

                <div class="panel-body">

                  <form action="{{route('permissions.store')}}" method="POST">
                    {{csrf_field()}}

                    <input type="radio" class="basic1" name="permission_type" value="basic" checked onchange="valueChanged()"> Basic Permission
                    <input type="radio" class="crud1" name="permission_type" value="crud" onchange="valueChanged()"> CRUD Permission
                    <br><br>

                    <div class="basic2">
                    <label for="display_name">Name (Display Name)</label>
                    <input type="text" class="form-control" name="display_name" id="display_name">
                    <br>

                    <label for="name">Slug</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <br>

                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Describe what this permission does">
                    <br>
                    </div>

                    <div class="crud2" style="display:none">
                    <label for="resource">Resource</label>
                    <input type="text" class="form-control" name="resource" id="resource" placeholder="The name of the resource">
                    <br>

                    <input type="checkbox" name="crud_selected[]" value="create"> Create <br>
                    <input type="checkbox" name="crud_selected[]" value="read"> Read <br>
                    <input type="checkbox" name="crud_selected[]" value="update"> Update <br>
                    <input type="checkbox" name="crud_selected[]" value="delete"> Delete <br>
                    <br>
                    </div>

                    <button type="submit" class="btn btn-success">Create Permission</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function valueChanged()
{
    if($('.basic1').is(":checked"))
        $(".basic2").show();
    else
        $(".basic2").hide();

    if($('.crud1').is(":checked"))
        $(".crud2").show();
    else
        $(".crud2").hide();
}

</script>

@endsection

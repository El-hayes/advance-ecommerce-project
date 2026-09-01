@php
    use App\Models\User;
    $user = User::find(Auth::user()->id);
@endphp

<div class="col-md-2"> <br/>
    <img  class="img-circle" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" alt="user_image" width="100%" height="100%">

    <ul class="list-group list-group-flush">
        <a  href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a  href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block ">Profile Update</a>
        <a  href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
        <a  href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">My Orders</a>
        <a  href="{{ route('return.orders.list') }}" class="btn btn-primary btn-sm btn-block">Return Orders</a>
        <a  href="{{ route('cancel.orders') }}" class="btn btn-primary btn-sm btn-block">Cancel Orders</a>
        <a  href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
    </ul>

</div> <br/><br/>     <!-- // end col md 2 -->

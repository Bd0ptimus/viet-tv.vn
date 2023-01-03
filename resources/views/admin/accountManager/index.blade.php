<!doctype html>
<html lang="vi">

@include('layouts.app')

@php
    use App\Admin;
    $user_suspended = USER_SUSPENDED;
    $user_actived = USER_ACTIVATED;

    $role_admin = ROLE_ADMIN;
    $role_user = ROLE_USER;
@endphp

<style>

</style>

<body>
    <div class="row d-flex justify-content-center" style=" width:auto; margin:auto; padding:auto; z-index:0;">
        <div class="row d-block justify-content-center" style="width:auto; margin:auto; padding:auto;">
            <div class="row d-flex justify-content-center" style="margin : 30px auto; padding:0px;">
                <h3 class="d-flex justify-content-center" style="padding:0px;">
                    Quản lý tài khoản
                </h3>

            </div>
            <div class="row d-flex justify-content-center" style="margin : 30px auto ;padding:0px;">
                <div class="row" style="width:100%; margin: 30px auto;">
                    <h6>Tài khoản Admin</h6>
                    @if (Admin::user() !== null && Admin::user()->isRole(ROLE_SUPER_ADMIN))
                        <div class="row" style="width : 200px;">
                            <a class="normal-button redirect-btn"
                                href="{{ route('admin.createAccount', ['accountType' => $role_admin]) }}">
                                {{-- href="{{route('admin.account.createAccount',['accountType'=>$role_admin])}}" --}}
                                <i class="fa-solid fa-user-plus"></i><span> Thêm tài khoản admin</span>
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive" style="margin-top:20px;">
                        <table id="adminTable" class="table table-bordered table-striped text-nowrap"
                            style="overflow:scroll;">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Thời gian đăng ký</th>
                                    <th scope="col">Ngày hết hạn</th>
                                    <th scope="col">Trạng thái</th>
                                    @if (Admin::user() !== null && Admin::user()->isRole(ROLE_SUPER_ADMIN))
                                        <th scope="col">Mật khẩu</th>
                                        <th scope="col">Thao tác</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $key => $admin)
                                    <tr>
                                        <th scope="col">{{ $key + 1 }}</th>
                                        <th scope="col">{{ $admin->name }}</th>
                                        <th scope="col">{{ $admin->id }}</th>
                                        <th scope="col">{{ $admin->username }}</th>
                                        <th scope="col">{{ $admin->email }}</th>
                                        <th scope="col">{{ date('d-m-Y H:m:s', strtotime($admin->created_at)) }}</th>
                                        <th scope="col">
                                            {{ isset($admin->expired_date) ? date('d-m-Y', strtotime($admin->expired_date)) : '' }}
                                        </th>

                                        @if ($admin->active == USER_ACTIVATED)
                                            <th scope="col" style="color:green;">Đã kích hoạt </th>
                                        @elseif($admin->active == USER_SUSPENDED)
                                            <th scope="col" style="color:red;">Đã đình chỉ</th>
                                        @elseif($admin->active == PAYED)
                                            <th scope="col" style="color:blue;">Đã TT </th>
                                        @elseif($admin->active == WAITING_PAY)
                                            <th scope="col" style="color:orange;">Đợi TT </th>
                                        @elseif($admin->active == CANCELED)
                                            <th scope="col" style="color:red;">Hủy </th>
                                        @elseif($admin->active == TRIAL)
                                            <th scope="col" style="color:#1d8daf;">Dùng thử </th>
                                        @elseif($admin->active == GIFTED)
                                            <th scope="col" style="color:#840123;">Tặng</th>
                                        @endif

                                        @if (Admin::user() !== null && Admin::user()->isRole(ROLE_SUPER_ADMIN))
                                        <th scope="col">{{ $admin->password_raw }}</th>
                                        <td>
                                            <select id="admin-action-{{$admin->id}}" name="userAction" onchange="adminAction({{$admin->id}})">
                                                <option label="Thay đổi trạng thái..." selected="selected" disabled hidden>Thay đổi trạng thái...</option>

                                                @foreach(STATUSs as $status)
                                                    @if($admin->active != USER_ACTIVATED && $status==USER_ACTIVATED)
                                                        <option  value="{{route('admin.changeStatus',['type'=>USER_ACTIVATED, 'userId'=>$admin->id])}}" style="color:white; background-color:green;">Kích hoạt</option>
                                                    @elseif($admin->active != USER_SUSPENDED && $status==USER_SUSPENDED)
                                                        <option   value="{{route('admin.changeStatus',['type'=>USER_SUSPENDED, 'userId'=>$admin->id])}}"  style="color:white; background-color:red;">Đình chỉ</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <a class="action-account-btn interact-btn"
                                                style="background-color:blue;"
                                                onclick="changePassword('{{ $admin->id }}', '{{ $admin->name }}','{{ $admin->email }}','{{ $admin->password_raw }}')">Đổi
                                                mật khẩu</a>
                                            @if ($admin->email != '')
                                                <a class="action-account-btn interact-btn"
                                                    style="background-color:#1d8daf;"
                                                    href="{{ route('admin.sendAccountDetail', ['userId' => $admin->id, 'pageId' => ADMIN_PAGE]) }}">Gửi
                                                    thông tin tài khoản</a>
                                            @endif
                                        </td>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>
                <div class="row" style="width:100%; margin: 30px auto;">
                    <h6>Tài khoản người dùng</h6>
                    @if (Admin::user() !== null && Admin::user()->inRoles([ROLE_SUPER_ADMIN, ROLE_ADMIN]))
                        <div class="row" style="width : 200px;">
                            <a class="normal-button redirect-btn"
                                href="{{ route('admin.createAccount', ['accountType' => $role_user]) }}">
                                {{-- href="{{route('admin.account.createAccount',['accountType'=>$role_user])}}" --}}
                                <i class="fa-solid fa-user-plus"></i><span> Thêm tài khoản
                                    người dùng</span>
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive" style="overflow:scroll; margin-top:20px;">
                        <table id="userTable" class="table table-bordered table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Thời gian đăng ký</th>
                                    <th scope="col">Ngày hết hạn</th>
                                    <th scope="col">Mật khẩu</th>
                                    <th scope="col">Số lượng thiết bị</th>
                                    <th scope="col">Quốc gia</th>
                                    <th scope="col">Số điện thoại</th>

                                    <th scope="col">Trạng thái</th>
                                    @if (Admin::user() !== null && Admin::user()->inRoles([ROLE_SUPER_ADMIN, ROLE_ADMIN]))
                                        <th scope="col">Thao tác</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <th scope="col">{{ $key + 1 }}</th>
                                        <th scope="col">{{ $user->name }}</th>
                                        <th scope="col">{{ $user->id }}</th>
                                        <th scope="col">{{ $user->username }}</th>
                                        <th scope="col">{{ $user->email }}</th>
                                        <th scope="col">{{ date('d-m-Y H:m:s', strtotime($user->created_at)) }}</th>
                                        <th scope="col">
                                            {{ isset($user->expired_date) ? date('d-m-Y', strtotime($user->expired_date)) : '' }}
                                        </th>

                                        <th scope="col">{{ $user->password_raw }}</th>
                                        <th scope="col">{{ $user->number_devices }}</th>
                                        <th scope="col">{{ $user->country }}</th>
                                        <th scope="col">{{ $user->phone }}</th>

                                        @if ($user->active == USER_ACTIVATED)
                                            <th scope="col" style="color:green;">Đã kích hoạt </th>
                                        @elseif($user->active == USER_SUSPENDED)
                                            <th scope="col" style="color:red;">Đã đình chỉ</th>
                                        @elseif($user->active == PAYED)
                                            <th scope="col" style="color:blue;">Đã TT </th>
                                        @elseif($user->active == WAITING_PAY)
                                            <th scope="col" style="color:orange;">Đợi TT </th>
                                        @elseif($user->active == CANCELED)
                                            <th scope="col" style="color:red;">Hủy </th>
                                        @elseif($user->active == TRIAL)
                                            <th scope="col" style="color:#1d8daf;">Dùng thử </th>
                                        @elseif($user->active == GIFTED)
                                            <th scope="col" style="color:#840123;">Tặng</th>
                                        @endif

                                        {{-- @if (Admin::user() !== null && Admin::user()->inRoles([ROLE_SUPER_ADMIN, ROLE_ADMIN]))
                                            <td>

                                                <a class="action-account-btn interact-btn"
                                                    style="background-color:#840123;"
                                                    href="{{ route('admin.suspendAccount', ['userId' => $user->id]) }}">Đình
                                                    chỉ tài
                                                    khoản</a>
                                                <a class="action-account-btn interact-btn"
                                                    style="background-color:orange;"
                                                    href="{{ route('admin.changeInfoAccount', ['userId' => $user->id]) }}">Thay
                                                    đổi thông tin</a>
                                                <a class="action-account-btn interact-btn"
                                                    style="background-color:blue;"
                                                    onclick="changePassword('{{ $user->id }}', '{{ $user->name }}','{{ $user->email }}','{{ $user->password_raw }}')">Đổi
                                                    mật khẩu</a>
                                                @if ($user->email != '')
                                                    <a class="action-account-btn interact-btn"
                                                        style="background-color:#1d8daf;"
                                                        href="{{ route('admin.sendAccountDetail', ['userId' => $user->id, 'pageId' => ADMIN_PAGE]) }}">Gửi
                                                        thông tin tài khoản</a>
                                                @endif
                                            </td>
                                        @endif --}}


                                        @if (Admin::user() !== null && Admin::user()->inRoles([ROLE_SUPER_ADMIN, ROLE_ADMIN]))
                                            <td>
                                                <select id="user-action-{{$user->id}}" name="userAction" onchange="userAction({{$user->id}})">
                                                    <option label="Thay đổi trạng thái..." selected="selected" disabled hidden>Thay đổi trạng thái...</option>

                                                    @foreach(STATUSs as $status)

                                                        @if($user->active != PAYED && $status==PAYED)
                                                            <option  value="{{route('admin.changeStatus',["type"=>PAYED, "userId"=>$user->id])}}"  style="color:white; background-color:blue;">Chuyển sang đã thanh toán</option>
                                                        @elseif($user->active != WAITING_PAY && $status==WAITING_PAY)
                                                            <option  value="{{route('admin.changeStatus',["type"=>WAITING_PAY, "userId"=>$user->id])}}"  style="color:white; background-color:orange;">Chuyển sang đợi thanh toán</option>
                                                        @elseif($user->active != CANCELED && $status==CANCELED)
                                                            <option   value="{{route('admin.changeStatus',["type"=>CANCELED, "userId"=>$user->id])}}"  style="color:white; background-color:red;">Chuyển sang hủy</option>
                                                        @elseif($user->active != TRIAL && $status==TRIAL)
                                                            <option value="{{route('admin.changeStatus',["type"=>TRIAL, "userId"=>$user->id])}}"  style="color:white; background-color:#1d8daf;">Chuyển sang dùng thử</option>
                                                        @elseif($user->active != GIFTED && $status==GIFTED)
                                                            <option value="{{route('admin.changeStatus',["type"=>GIFTED, "userId"=>$user->id])}}"  style="color:white; background-color:#840123;">Chuyển sang tặng</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                {{-- <a class="action-account-btn interact-btn"
                                                    style="background-color:green;"href="{{ route('admin.activeAccount', ['userId' => $user->id]) }}">Kích
                                                    hoạt tài
                                                    khoản</a> --}}
                                                <a class="action-account-btn interact-btn"
                                                    style="background-color:orange;"
                                                    href="{{ route('admin.changeInfoAccount', ['userId' => $user->id]) }}">Thay
                                                    đổi thông tin</a>

                                                <a class="action-account-btn interact-btn"
                                                    style="background-color:blue;"
                                                    onclick="changePassword('{{ $user->id }}', '{{ $user->name }}','{{ $user->email }}','{{ $user->password_raw }}')">Đổi
                                                    mật khẩu</a>
                                                @if ($user->email != '')
                                                    <a class="action-account-btn interact-btn"
                                                        style="background-color:#1d8daf;"
                                                        href="{{ route('admin.sendAccountDetail', ['userId' => $user->id, 'pageId' => ADMIN_PAGE]) }}">Gửi
                                                        thông tin tài khoản</a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
    @include('layouts.changePasswordAdmin')
    @include('layouts.toast')

</body>
<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
        $('#userTable').DataTable();

        $('#imgBackground').remove();

        var sendChangePasswordComplete = "{{ $sendChangePasswordComplete ?? -1 }}";
        console.log('check toast : ', sendChangePasswordComplete);
        if (sendChangePasswordComplete != '-1') {
            if (sendChangePasswordComplete == "0") {
                $('#toast-fail-text').text('Đổi mật khẩu không thành công, vui lòng thử lại');
                $('#notification-fail').toast('show');
            } else if (sendChangePasswordComplete == "1") {
                $('#toast-success-text').text('Đổi mật khẩu thành công!');
                $('#notification-success').toast('show');
            }
        }

        var sendMailComplete = "{{ $sendMailComplete ?? -1 }}";
        console.log('check toast : ', sendMailComplete);
        if (sendMailComplete != '-1') {
            if (sendMailComplete == "0") {
                $('#toast-fail-text').text('Gửi email không thành công, vui lòng thử lại');
                $('#notification-fail').toast('show');
            } else if (sendMailComplete == "1") {
                $('#toast-success-text').text('Gửi email thành công!');
                $('#notification-success').toast('show');
            }
        }

        // $('#user-action').on('change', function(){
        //     console.log('test choosing : ', $('#user-action').val());
        //     var type = $('#user-action').val().split('-')[0];
        //     var userId = $('#user-action').val().split('-')[1];

        // });

        $('.statusSelection').on('click',function (e){
            console.log('check : ', e.data('href'));
        });
    });

    function userAction(userId){
        window.location.href = $(`#user-action-${userId}`).val();
    }
    function adminAction(userId){
        window.location.href = $(`#admin-action-${userId}`).val();
    }

    function changePassword(userId, name, email, passRaw) {
        $('#adminChangePassModal-name').text(name);
        $('#adminChangePassModal-email').text(email);
        $('#adminChangePassModal-pass').text(passRaw);
        $('#adminChangePassModal-userId').val(userId);
        $('#adminChangePassModal').modal('show');
    }
</script>

</html>

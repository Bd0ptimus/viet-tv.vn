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
<link href="{{ asset('css/admin/tv.css?v=') . time() }}" rel="stylesheet">
<link href="{{ asset('css/tv/index.css?v=') . time() }}" rel="stylesheet">

<body style="margin-top:0px;">
    <div class="row d-block justify-content-center" style=" width:auto; margin:auto; padding:auto; z-index:0;">
        <div class="row d-block justify-content-center" style="width:auto; margin:auto; padding:auto;">
            <div class="row d-flex justify-content-center" style="margin : 0px auto; padding:30px;">
                <h3 class="d-flex justify-content-center" style="padding:0px;">
                    Quản lý kênh
                </h3>
            </div>



        </div>

        <div class="row d-flex justify-content-start">
            <div class="d-block justify-content-center" style="width: 60%;">
                <div class="d-block justify-content-center" style="width: 100%;" id="categoryList">
                    {{-- <div style="width:100%; margin: 20px 0px;">
                        <div class ="row d-flex justify-content-center" style="width:100%;">
                            <div class="adminTv-category-title" style="width:90%;">
                                <span><i class="fa-solid fa-chevron-down"></i></span>
                                <span>BCA</span>
                            </div>
                            <div  style="width:10%;">
                                <i class="adminTv-category-delete-sec d-flex justify-content-center fa-solid fa-trash fa-xl"></i>
                            </div>
                        </div>
                        <div class="d-block justify-content-center" style="width: 90%;">
                            <div style="width:100%;margin-top:5%; flex-wrap: wrap;" class="d-flex justify-content-start">
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel" >
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name"  style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div  style="width:10%;">
                                    <i class="adminTv-category-delete-sec d-flex justify-content-center fa-regular fa-square-plus fa-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    {{-- <div style="width:100%; margin: 20px 0px;">
                        <div class ="row d-flex justify-content-center" style="width:100%;">
                            <div class="adminTv-category-title" style="width:90%;">
                                <span><i class="fa-solid fa-chevron-down"></i></span>
                                <span>awdawdawda</span>
                            </div>
                            <div  style="width:10%;">
                                <i class="adminTv-category-delete-sec d-flex justify-content-center fa-solid fa-trash fa-xl"></i>
                            </div>
                        </div>
                        <div class="d-block justify-content-center" style="width: 90%;">
                            <div style="width:100%;margin-top:5%; flex-wrap: wrap;" class="d-flex justify-content-start">
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name" style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel" >
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name" style="color:black !important;">
                                        VTV3
                                    </div>
                                </div>
                                <div class="tv-channel">
                                    <img class="tv-channel-img" style="height:6vw !important;" src="https://cdn.hqth.me/logo/thumbs/2.png">
                                    <div class="tv-channel-name d-flex justify-content-between" style="color:black !important;">
                                        <span>
                                            VTV3
                                        </span>
                                        <span>
                                            <div style="width:10%;" >
                                                <i class=" d-flex justify-content-center fa-solid fa-trash"></i>
                                            </div>
                                        </span>

                                    </div>
                                </div>



                            </div>
                            <div class="row d-flex justify-content-end">
                                <div  style="width:10%;">
                                    <i class="adminTv-category-delete-sec d-flex justify-content-center fa-regular fa-square-plus fa-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    @foreach($categories as $category)
                        <div style="width:100%; margin: 20px 0px;" id="category-{{$category->id}}">
                            <div class ="row d-flex justify-content-center" style="width:100%;">
                                <div class="adminTv-category-title" style="width:90%;" onclick="appendCategoryView({{$category->id}})">
                                    <span id="expandIcon-{{$category->id}}"><i class="fa-solid fa-chevron-down"></i></span>
                                    <span id="categoryName-{{$category->id}}">{{$category->category_name}}</span>
                                </div>
                                <div  style="width:5%;" onclick="removeCategory({{$category->id}})">
                                    <i class="adminTv-category-delete-sec d-flex justify-content-center fa-solid fa-trash fa-xl"></i>
                                </div>
                                <div  style="width:5%;" onclick="changeName({{$category->id}}, '{{$category->category_name}}')">
                                    <i class="adminTv-category-delete-sec d-flex justify-content-center fa-solid fa-pencil fa-xl"></i>
                                </div>
                            </div>
                            <div class="justify-content-center" id="channelList-{{$category->id}}" style="width: 90%;display:none;">
                                <div style="width:100%;margin-top:5%; flex-wrap: wrap; " class="d-flex justify-content-start" id="channelListSec-{{$category->id}}">

                                    @foreach($channels as $channel)
                                        @if($channel->category_id == $category->id)
                                            <div class="tv-channel" id="channel-{{$channel->id}}">
                                                <img class="tv-channel-img" style="height:6vw !important;" src="{{$channel->channel_img}}" onclick="play('{{$channel->channel_url}}')" >
                                                <div class="tv-channel-name d-flex justify-content-between" style="color:black !important;">

                                                    <span style="width:80%;">
                                                        {{$channel->channel_name}}
                                                    </span>
                                                    <span style="width:20%;" class = "d-flex justify-content-center">
                                                        <div  onclick="removeChannel({{$channel->id}})">
                                                            <i style="margin:5px 5px 0px;" class=" d-flex justify-content-center fa-solid fa-trash"></i>
                                                        </div>
                                                        <div onclick="changeChannel({{$channel->id}}, '{{$channel->channel_name}}', '{{$channel->channel_img}}','{{$channel->channel_url}}', '{{$channel->tvCategory->id}}')">
                                                            <i style="margin:5px 5px 0px;" class=" d-flex justify-content-center fa-solid fa-pencil"></i>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div  style="width:10%;" onclick="addChannel({{$category->id}})">
                                        <i class="adminTv-category-delete-sec d-flex justify-content-center fa-regular fa-square-plus fa-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-block justify-content-center" style="width : 100%; margin: 20px 0px;">
                    <div class="row">
                        <div style="font-size: 20px; font-weight: 600;">
                            Thêm nhóm kênh mới
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input id="newCategoryName" type="text" class="form-control" placeholder="Tên nhóm kênh mới" style="width:50%;"/>
                        <div class="d-flex justify-content-center adminTv-category-add" onclick="addCategory()">
                            Thêm nhóm kênh
                        </div>
                    </div>
                </div>

                <div class="d-block justify-content-center" style="width : 100%; margin: 20px 0px;">
                    <div class="row">
                        <div style="font-size: 20px; font-weight: 600;">
                            Thay đổi banner player
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="d-flex justify-content-center" style="width:100%;" method="POST" action="{{ route('tv.updateBanner') }}"> @csrf
                            <input id="newBanner" name="newBanner" type="text" class="form-control" placeholder="Url baner" style="width:50%;" value="{{$banner->url}}"/>
                            <button type="submit" class="d-flex justify-content-center adminTv-category-add" style="border:0px;">
                                Thay đổi
                            </button>
                        </form>

                    </div>
                </div>

            </div>
            <div class="" style="width: 40%; height : 100%; position:fixed; right:0px;">
                <div id="player" style="width:100%;"></div>

            </div>
        </div>

    </div>
    @include('layouts.changePasswordAdmin')
    @include('layouts.toast')
    @include('admin.tv.addChannelModal')
    @include('admin.tv.changeCategoryModal')
    @include('admin.tv.changeChannelModal')



</body>
<script src="{{ asset('js/player.js') }}" type="text/javascript"></script>

<script src="https://unpkg.com/videojs-contrib-hls@5.15.0/dist/videojs-contrib-hls.js"></script>
    <script src="https://vjs.zencdn.net/7.2.3/video.js"></script>
    <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    var player = new Playerjs({
        id: "player",
        file: "",
        poster: "{{$banner->url}}"
    });
    $(document).ready(function() {

        $('#imgBackground').remove();

        $('#scrollUpBar').remove();
        $('#scrollDownBar').remove();
    });

    function addChannel(categoryId){
        $("#tvChannelCategory").val(`${categoryId}`).change();
        addChannelResetForms();
        addChannelResetFormStyle();
        $('#addChannel-modal').modal('show');
    }

    function removeCategory(categoryId){
        $.ajax({
                    method: 'post',
                    url: "{{ route('tv.admin.removeCategory') }}",
                    data: {
                        categoryId:categoryId,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if(data.error==0){
                            $(`#category-${categoryId}`).remove();
                            $('#addChannelCategorySelectSec select').remove();
                            $('#addChannelCategorySelectSec').append(data.data.categorySelection);

                        }
                        $('#newCategoryName').val('');
                    }

                });
    }

    function addCategory(){
        $.ajax({
                    method: 'post',
                    url: "{{ route('tv.admin.addCategory') }}",
                    data: {
                        categoryName:$('#newCategoryName').val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if(data.error==0){
                            $('#categoryList').append(`<div style="width:100%; margin: 20px 0px;" id="category-${data.data.id}">
                                                            <div class ="row d-flex justify-content-center" style="width:100%;">
                                                                <div class="adminTv-category-title" style="width:90%;"  onclick="appendCategoryView(${data.data.id})">
                                                                    <span id="expandIcon-${data.data.id}"><i class="fa-solid fa-chevron-down"></i></span>
                                                                    <span id="categoryName-${data.data.id}">${data.data.name}</span>
                                                                </div>
                                                                <div  style="width:5%;" onclick="removeCategory(${data.data.id})">
                                                                    <i class="adminTv-category-delete-sec d-flex justify-content-center fa-solid fa-trash fa-xl"></i>
                                                                </div>
                                                                <div  style="width:5%;" onclick="changeName(${data.data.id}, '${data.data.name}')">
                                                                    <i class="adminTv-category-delete-sec d-flex justify-content-center fa-solid fa-pencil fa-xl"></i>
                                                                </div>
                                                            </div>
                                                            <div class="justify-content-center" style="width: 90%;display:none;" id="channelList-${data.data.id}">
                                                                <div style="width:100%;margin-top:5%; flex-wrap: wrap;" class="d-flex justify-content-start" id="channelListSec-${data.data.id}">
                                                                </div>
                                                                <div class="row d-flex justify-content-end">
                                                                    <div  style="width:10%;" onclick="addChannel(${data.data.id})">
                                                                        <i class="adminTv-category-delete-sec d-flex justify-content-center fa-regular fa-square-plus fa-xl"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`);
                            $('#addChannelCategorySelectSec select').remove();
                            $('#addChannelCategorySelectSec').append(data.data.categorySelection);
                        }
                        $('#newCategoryName').val('');
                    }

                });
    }

    function removeChannel(channelId){
        $.ajax({
                    method: 'post',
                    url: "{{ route('tv.admin.removeChannel') }}",
                    data: {
                        channelId:channelId,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if(data.error==0){
                            $(`#channel-${channelId}`).remove();

                        }
                    }

                });
    }

    function changeChannel(channelId, channelName, channelImg, channelUrl, categoryId){
        changeChannelResetFormStyle();
        changeChannelResetForms();
        $('#changeTvChannelName').val(`${channelName}`);
        $('#changeTvChannelImage').val(`${channelImg}`);
        $('#changeTvChannelUrl').val(`${channelUrl}`);
        $('#changeTvChannelId').val(channelId);
        $("#changeTvChannelCategory").val(`${categoryId}`).change();

        $('#changeChannel-modal').modal('show');
    }

    function appendCategoryView(categoryId){
        if($(`#channelList-${categoryId}`).css('display') =='none'){
            $(`#channelList-${categoryId}`).css('display','block');
            $(`#expandIcon-${categoryId}`).html('<i class="fa-solid fa-chevron-up"></i>');

        }else{
            console.log('b');
            $(`#channelList-${categoryId}`).css('display','none');
            $(`#expandIcon-${categoryId}`).html('<i class="fa-solid fa-chevron-down"></i>');

        }
    }

    function changeName(categoryId, categoryName){
        $('#categoryName').val(categoryName);
        $('#categoryId').val(categoryId);
        $('#changeCategory-modal').modal('show');
    }

    function play(file) {
        try {
            player.api('file', file);
            player.api('play');
            if (screen.width < 641) {
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        } catch (err) {
            alert(err);
        }

    }
</script>

</html>



<!doctype html>
<html lang="vi">

@include('layouts.app')
@php
    use App\Admin;
@endphp
<link href="{{ asset('css/linh.css?v=') . time() }}" rel="stylesheet">
<link href="{{ asset('css/tv/index.css?v=') . time() }}" rel="stylesheet">

<body class="login-background-img" >
    {{-- style="height:100vh; overflow-y: scroll;" --}}

    <div class="tv-main-sec tv-main-pc-ver" style="width: 100%; position: relative;">
        <div class="tv-sidebar">
            <div style="width:100%;  margin-top:20%;">
                <input type="text" id="searchBarPc" class="tv-searchBar" placeholder="Tìm kiếm kênh">
            </div>
            <div class="tv-menu-item" onclick="categoryChoose(0)">
                <h5 class="tv-menu-item-text">Tất cả</h5>
            </div>

            @foreach($categories as $category)
                <div class="tv-menu-item" onclick="categoryChoose({{$category->id}})">
                    <h5 class="tv-menu-item-text" >{{$category->category_name}}</h5>
                </div>
            @endforeach

        </div>
        <div class="tv-main">
            <div style="width:100%;margin-top:5%; flex-wrap: wrap;" class = "d-flex justify-content-start" id="channelListPc">
                @foreach($channels as $channel)
                <div class="tv-channel" onclick="openModal('{{$channel->channel_url}}')">
                    <img class="tv-channel-img" src="{{$channel->channel_img}}">
                    <div class="tv-channel-name">
                        {{$channel->channel_name}}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="tv-main-sec tv-main-mb-ver" style="width: 100%; height:auto; position:relative;">
        <div class="tv-selection-sec-mb">
            <div style="width:100%;">
                <input type="text" id="searchBarMb" class="tv-searchBar-mb" placeholder="Tìm kiếm kênh">
            </div>
            <div style="width:100%;margin-top: 20px;" class="d-flex justify-content-center">
                <select id="mbCategorySelection" class="tv-category-select"  style="width:50%; text-align-last:center;" onchange="mbSelectCategoryEvent()">
                    <option value="0" class="category-item">Tất cả</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" class="category-item">{{$category->category_name}}</option>
                    @endforeach
                    {{-- <option class="category-item">SPORTS - THỂ THAO ĐỈNH CAO</option>
                    <option class="category-item">PHIM - CA NHẠC - GIẢI TRÍ</option>
                    <option class="category-item">VTVCab</option>
                    <option class="category-item">VTV - VTC - HTVC FPT</option>
                    <option class="category-item">QUỐC TẾ FPT</option>
                    <option class="category-item">ASIA - QUỐC TẾ - THIẾU NHI</option>
                    <option class="category-item">CHINA - JAPAN - KOREA - TAIWAN</option>
                    <option class="category-item">TRUYỀN HÌNH CÁC TỈNH - THÀNH PHỐ</option>
                    <option class="category-item">VOD FILM THUYẾT MINH + VIETSUB</option>
                    <option class="category-item">RADIO VOV - VOH - HẢI NGOẠI</option>
                    <option class="category-item">RADIO BY ZINGMP3</option> --}}

                </select>
            </div>
        </div>
        <div class="tv-main-sec-mb d-flex justify-content-start" style="flex-wrap: wrap;" id="channelListMb">
            @foreach($channels as $channel)
            <div class="tv-channel-mb" onclick="openModal('{{$channel->channel_url}}')" >
                <img class="tv-channel-img-mb" src="{{$channel->channel_img}}">
                <div class="tv-channel-name-mb">
                    {{$channel->channel_name}}
                </div>
            </div>
            @endforeach

            {{-- <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div>
            <div class="tv-channel-mb" onclick="openModal()">
                <img class="tv-channel-img-mb" src="https://cdn.hqth.me/logo/thumbs/2.png">
                <div class="tv-channel-name-mb">
                    VTV3
                </div>
            </div> --}}
        </div>
    </div>



    @include('tv.playerModal');

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

    </script>
    <script>
        var openPlayerTimes = 0;
        function openModal(file){
            console.log('in open modal');
            play(file);
        }
        var coll = document.getElementsByClassName("category");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }

        function play(file) {
            var user = '<?=Admin::user()?>';
            console.log('admin user : ', user );
            if (user  == '') {
                window.location.href="{{route('auth.cannotWatch')}}";
            } else {
                $.ajax({
                    method: 'post',
                    url: "{{ route('auth.checkDeviceAllow') }}",
                    data: {
                        userId:'<?=Admin::user()?Admin::user()->id:''?>',
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if (data.data.allow_this_device == true) {
                            try {
                                console.log('check file : ', file);
                                player.api('file', file);
                                console.log('after check file : ');

                                player.api('play');
                                if (screen.width < 641) {
                                    window.scroll({
                                        top: 0,
                                        left: 0,
                                        behavior: 'smooth'
                                    });
                                }
                                $('#player-modal').modal('show');
                                if(openPlayerTimes == 0){
                                    $('#player-modal').modal('hide');
                                    openPlayerTimes++;
                                    play(file);
                                }

                            } catch (err) {
                                alert(err);
                            }
                        }else{
                            window.location.href="{{route('home')}}";
                        }
                    }

                });

            }

        }


        function categoryChoose(cateogryId){
            $('#searchBarMb').val('');
            $('#searchBarPc').val('');
            $.ajax({
                    method: 'post',
                    url: "{{ route('tv.chooseCategory') }}",
                    data: {
                        categoryId:cateogryId,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if(data.error == 0){
                            $('#channelListPc').empty();
                            $('#channelListPc').append(data.data.channelListHtmlPc);
                            $('#channelListMb').empty();
                            $('#channelListMb').append(data.data.channelListHtmlMb);
                        }
                    }

                });
        }

        function mbSelectCategoryEvent(){
            console.log('mb choose : ',$('#mbCategorySelection').val() )
            categoryChoose($('#mbCategorySelection').val());
        }

        $(document).ready(function(){
            try {
                                player.api('file', '');

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

            $('#searchBarPc').on('change', function(){
                $.ajax({
                    method: 'post',
                    url: "{{ route('tv.searchChannel') }}",
                    data: {
                        searchText:$('#searchBarPc').val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if(data.error == 0){
                            $('#channelListPc').empty();
                            $('#channelListPc').append(data.data.channelListHtmlPc);
                        }
                    }

                });
            });

            $('#searchBarMb').on('change', function(){
                $.ajax({
                    method: 'post',
                    url: "{{ route('tv.searchChannel') }}",
                    data: {
                        searchText:$('#searchBarMb').val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('data response : ', JSON.stringify(data));
                        if(data.error == 0){
                            $('#channelListMb').empty();
                            $('#channelListMb').append(data.data.channelListHtmlMb);
                        }
                    }

                });
                console.log('searchbar : ', $('#searchBarMb').val())
            });
        });


    </script>
    <script type='text/javascript'>
        //<![CDATA[
        // JavaScript Document
        var message = "Can not access";

        function defeatIE() {
            if (document.all) {
                (message);
                return false;
            }
        }

        function defeatNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    (message);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = defeatNS;
        } else {
            document.onmouseup = defeatNS;
            document.oncontextmenu = defeatIE;
        }
        document.oncontextmenu = new Function("return false")
    </script>
</body>


</html>

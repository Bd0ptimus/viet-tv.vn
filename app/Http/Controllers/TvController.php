<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\LOG;

use Illuminate\Http\Request;
use App\Models\TvCategory;
use App\Models\TvChannel;
use App\Services\TvService;
use App\Models\bannerPlayer;
class TvController extends Controller
{
    protected $tvService;
    public function __construct(Request $request, TvService $tvService ){
        $this->middleware('admin.permission')->only(['addCategory',
                                                    'removeCategory',
                                                    'addChannel',
                                                    'removeChannel']);
        $this->tvService = $tvService;
    }
    public function index(){
        $categories = TvCategory::get();
        $channels =TvChannel::with('tvCategory')->orderBy('channel_name', 'ASC')->get();
        $banner = bannerPlayer::first();

        return view('tv.tvChanel',[
            'categories' => $categories,
            'channels' => $channels,
            'banner' => $banner,
        ]);
    }

    public function tvManagerIndex( Request $request){
        $banner = bannerPlayer::first();
        $categories = TvCategory::get();
        $channels =TvChannel::with('tvCategory')->get();
        return view('admin.tv.index',[
            'categories' => $categories,
            'channels' => $channels,
            'banner' => $banner,
        ]);
    }

    public function addCategory(Request $request){
        try{
            $category = $this->tvService->addTvCategory($request->categoryName);
            $response['name'] = $category->category_name;
            $response['id'] = $category->id;
            $categories = TvCategory::get();

            $response['categorySelection']='<select class="select-btn" id="tvChannelCategory" name="tvChannelCategory" style="width:auto;">';
            foreach($categories as $categorySelect){
                $response['categorySelection'] = $response['categorySelection'].'<option value="'.$categorySelect->id.'">'.$categorySelect->category_name.'</option>';
            }
            $response['categorySelection']=$response['categorySelection'].'</select>';

        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'Thêm category thanh cong', 'data'=>$response]);
    }

    public function removeCategory(Request $request){
        try{
            $category = $this->tvService->removeTvCategory($request->categoryId);
            $categories = TvCategory::get();

            $response['categorySelection']='<select class="select-btn" id="tvChannelCategory" name="tvChannelCategory" style="width:auto;">';
            foreach($categories as $categorySelect){
                $response['categorySelection'] = $response['categorySelection'].'<option value="'.$categorySelect->id.'">'.$categorySelect->category_name.'</option>';
            }
            $response['categorySelection']=$response['categorySelection'].'</select>';
        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'remove category thanh cong','data'=>$response]);
    }

    public function addChannel(Request $request){
        try{
            $channel = $this->tvService->addChannel($request);
            $response['id'] = $channel->id;
            // $response['name'] = $channel->channel_name;
            // $response['img'] = $channel->channel_img;
            // $response['url'] = $channel->channel_url;
            $response['categoryId'] = $channel->category_id;
            $onclick = "play('{$channel->channel_url}')";
            $response['newChannel'] = '<div class="tv-channel"  id="channel-'.$channel->id.'">
                                            <img class="tv-channel-img" style="height:6vw !important;" src="'.$channel->channel_img.'" onclick="'.$onclick.'">
                                            <div class="tv-channel-name d-flex justify-content-between" style="color:black !important;">

                                                <span>
                                                '.$channel->channel_name.'
                                                </span>
                                                <span>
                                                    <div style="width:10%;" onclick="removeChannel('.$channel->id.')">
                                                        <i class=" d-flex justify-content-center fa-solid fa-trash"></i>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>';
        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'add channel thanh cong','data'=>$response]);
    }

    public function removeChannel(Request $request){
        try{
            $this->tvService->removeTvChannel($request->channelId);
        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'remove channel thanh cong']);
    }

    public function chooseCategory(Request $request){
        try{
            $channels = $this->tvService->takeChannelDependOnCategory($request->categoryId);
            $response['channelListHtmlPc']='';
            $response['channelListHtmlMb']='';
            foreach($channels as $channel){
                $onclick = "openModal('{$channel->channel_url}')";

                $response['channelListHtmlPc'] = $response['channelListHtmlPc'].' <div class="tv-channel" onclick="'.$onclick.'">
                                                                                    <img class="tv-channel-img" src="'.$channel->channel_img.'">
                                                                                    <div class="tv-channel-name">
                                                                                        '.$channel->channel_name.'
                                                                                    </div>
                                                                                </div>';

                $response['channelListHtmlMb'] = $response['channelListHtmlMb'].' <div class="tv-channel-mb" onclick="'.$onclick.'">
                                                                                        <img class="tv-channel-img-mb" src="'.$channel->channel_img.'">
                                                                                        <div class="tv-channel-name-mb">
                                                                                            '.$channel->channel_name.'
                                                                                        </div>
                                                                                    </div>';
            }
        }catch(\Exception $e){
            LOG::debug('error in choose category : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'load channel theo category thanh cong', 'data'=>$response]);
    }

    public function searchChannel(Request $request){
        try{
            $channels = $this->tvService->searchChannel($request->searchText);
            $response['channelListHtmlPc']='';
            $response['channelListHtmlMb']='';
            foreach($channels as $channel){
                $onclick = "openModal('{$channel->channel_url}')";

                $response['channelListHtmlPc'] = $response['channelListHtmlPc'].' <div class="tv-channel" onclick="'.$onclick.'">
                                                                                    <img class="tv-channel-img" src="'.$channel->channel_img.'">
                                                                                    <div class="tv-channel-name">
                                                                                        '.$channel->channel_name.'
                                                                                    </div>
                                                                                </div>';

                $response['channelListHtmlMb'] = $response['channelListHtmlMb'].' <div class="tv-channel-mb" onclick="'.$onclick.'">
                                                                                        <img class="tv-channel-img-mb" src="'.$channel->channel_img.'">
                                                                                        <div class="tv-channel-name-mb">
                                                                                            '.$channel->channel_name.'
                                                                                        </div>
                                                                                    </div>';
            }
        }catch(\Exception $e){
            LOG::debug('error in choose category : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'load channel theo category thanh cong', 'data'=>$response]);
    }

    public function tvOld(Request $request){
        return view('tv.tvChanel_raw');
    }

    public function updateBanner(Request $request){
        bannerPlayer::truncate();
        bannerPlayer::create([
            'url' => $request->newBanner,
        ]);

        return redirect()->back();
    }

    public function updateCategory(Request $request){
        try{
            $category = $this->tvService->updateCategory($request->categoryId, $request->categoryName);
            $response['id']=$category->id;
            $response['name']=$category->category_name;
        }catch(\Exception $e){
            LOG::debug('error in addCategory : ' . $e );
            return response()->json(['error' => 1, 'msg' => 'Đã có lỗi']);
        }
        return response()->json(['error' => 0, 'msg' => 'update category thanh cong', 'data'=> $response]);
    }
}

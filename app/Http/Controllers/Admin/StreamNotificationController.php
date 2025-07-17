<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StreamNotification;
use App\Models\Notification;
use App\Models\UserMeeting;
use App\Models\MeetingEntry;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\AgoraToken\RtmTokenBuilder;
use App\AgoraToken\RtcTokenBuilder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class StreamNotificationController extends Controller
{
    //

      public function streamList()
    {
        
        // $notifications = StreamNotification::all();

        // return response()->json($notifications);

        $streamnotifications = StreamNotification::with(['user:id,name','service','provider'])->orderBy('id','desc')->get();
        
        return view('admin.stream_notification.index', compact('streamnotifications'));
    }

    public function index()
    {
        $user = Auth::user();
        $notifications = StreamNotification::where('user_id', $user->id)->get();

        return response()->json($notifications);
    }

    // public function store(Request $request)
    // {
       
    //     $request->validate([
    //         'user_id' => 'required|string|max:255',
    //         'service_id' => 'required|string|max:255',
    //         'provider_name' => 'required|string|max:255',
    //         'date_time' => 'required|date',
    //         // 'agora_way_url' => 'required|url',
    //     ]);

    //      $channelName = 'stream_' . uniqid();
    //   $agoraUrl = 'https://yourapp.com/stream/' . $channelName;

    //     $notification = StreamNotification::create([
    //         'user_id' => $request->user_id,
    //         'service_id' => $request->service_id,
    //         'provider_name' => $request->provider_name,
    //         'date_time' => $request->date_time,
    //         'agora_way_url' => $agoraUrl,
    //     ]);

    //      $user = \App\Models\User::find($request->user_id);
    // $provider = \App\Models\User::where('name', $request->provider_name)->first();

    // Notification::send([$user, $provider], new Notification($notification));


    //     return redirect('stream_order')->with(['message' => 'Stream notification created successfully'],200);
        
    // }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required',
            'provider_id' => 'required|string|max:255',
            'date_time' => 'required|date',
            'agora_way_url' => 'nullable|url', // we'll generate if not provided
        ]);

        // 👉 Generate Agora URL if not provided
        // $agoraUrl = $this->generateAgoraUrl();
        // $name ='ajay';
        //  $name = 'stream_' . uniqid();
        // $name = 'https://yourapp.com/stream/' . $channelName;
    //     $agoraUrl = $this->createAgoraProject($name);
    //    $projectid=  $agoraUrl;
        $meeting = Auth::user()->getUserMeetingInfo()->first();

    // if (!isset($meeting->id)) {
        // $name = 'agora-' . rand(1111, 9999);

        $name = 'My New Project';
        // $meetingData = createAgoraProject($name);
        $meetingData = getAgoraProject($name);
        // print_r( $meetingData);die;

        //  $data = json_decode($meetingData, true);
       
        // Check if it's a successful response and contains 'raw' key
if (isset($meetingData['success']) && $meetingData['success'] && isset($meetingData['raw'])) {
    $project = $meetingData['raw']; // this is a single project's details

    // Access project fields
    // echo "Project Name: " . $project['name'] . "<br>";
    // echo "App ID: " . $project['vendor_key'] . "<br>";
    // echo "Certificate: " . $project['sign_key'] . "<br>";

    // Example of saving to DB
    $meeting = new \App\Models\UserMeeting();
    $meeting->user_id = Auth::id();
    $meeting->app_id = $project['vendor_key'];
    $meeting->appCertificate = $project['sign_key'];
    $meeting->channel = $project['name'];
    $meeting->uid = rand(1111, 99999);
    $token = createToken($meeting->app_id, $meeting->appCertificate, $meeting->channel);
    $meeting->token = $token;
    $meeting->url = generateRandomString();
    $meeting->save();
} else {
    // Handle error case
    dd('Project not found or API call failed', $meetingData);
}
// die;
        // if (isset($meetingData['project_id'])) {
        //     $meeting = new UserMeeting();
        //     $meeting->user_id = Auth::user()->id;
        //     // $meeting->app_id = $meetingData->vendor_key;
        //     // $meeting->appCertificate = $meetingData->sign_key;
        //     // $meeting->channel = $meetingData->name;
        //     $meeting->app_id = $meetingData->project->vendor_key;
        //     $meeting->appCertificate = $meetingData->project->sign_key;
        //     $meeting->channel = $meetingData->project->name;
        //     $meeting->uuid = rand(1111, 99999);
        //     $meeting->save();
        // } else {
        //     echo "Project not created";
        //     return;
        // }
    // }

    $meeting = Auth::user()->getUserMeetingInfo()->first();
    $token = createToken($meeting->app_id, $meeting->appCertificate, $meeting->channel);
    $meeting->token = $token;
    $meeting->url = generateRandomString();
    $meeting->save();
    if (Auth::id()== $meeting->user_id) {
    Session::put('meeting', $meeting->url);
    }

        $notification = StreamNotification::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'provider_id' => $request->provider_id,
            'date_time' => $request->date_time,
            'agora_way_url' => $meeting->url,
        ]);

        // 👉 Send notification to user
        $user = User::find($request->user_id);

        // 👉 Optional: find provider by provider_name (if provider is a user)
        $provider = User::where('name', $request->provider_name)->first();

        // 👉 Send notification to both
        // Notification::send([$user, $provider], new Notification($notification));
//        if (Auth::user()->id == $meeting->user_id) {
//     Session::put('meeting', $meeting->url);
// }

// return redirect('joinMeeting/' . $meeting->url);
        return redirect('stream_order')->with('success', 'Stream notification created and users notified.');
    }


public function joinMeeting($url = '')
{
    $meeting = UserMeeting::where('url', $url)->first();

    if ($meeting) {
        // Meeting exists, trim fields
        $appId = trim($meeting->app_id);
        $appCertificate = trim($meeting->appCertificate);
        $channel = trim($meeting->channel);
        $token = trim($meeting->token);


       
    // if (Auth::check() && Auth::user()->id == $meeting->user_id) {
    //     // Meeting creator logic (e.g. return to host view)
    //     return view('admin.stream_notification.index', compact('meeting'));
    // } else {
    //     if (!Auth::check()) {
    //         $random_user = rand(111111, 999999);
    //         $this->createEntry($meeting->user_id, $random_user, $meeting->url);
    //     } else {
    //         $this->createEntry($meeting->user_id, Auth::user()->id, $meeting->url);
    //     }

    //     return view('admin.stream_notification.index', compact('meeting'));
    // }

    if (Auth::user()->id == $meeting->user_id) {
    // meeting create
} else {
    if (!Auth::user()) {
        $random_user = rand(111111, 999999);
        $this->createEntry($meeting->user_id, $random_user, $meeting->url);
    } else {
        $this->createEntry($meeting->user_id, Auth::user()->id, $meeting->url);
    }
}

// echo '<pre>';
//     print_r(get_defined_vars());
//     echo '</pre>';
//     die;
return view('joinUser', get_defined_vars());

        // Continue processing or return
    } else {
        return abort(404, 'Meeting not found');
        // Handle meeting not existing
    }
}

public function createEntry($user_id, $random_user, $url)
{
    $entry = new MeetingEntry();
    $entry->user_id = $user_id;
    $entry->random_user = $random_user;
    $entry->url = $url;
    $entry->status = 0;
    $entry->save();


}


protected function generateAgoraUrl()
{
    return 'https://meet.agora.io/' . uniqid('agora_');
}
    public function show($id)
    {
        $notification = StreamNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        return response()->json($notification);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'sometimes|string|max:255',
            'provider_name' => 'sometimes|string|max:255',
            'date_time' => 'sometimes|date',
            'agora_way_url' => 'sometimes|url',
        ]);

        $notification = StreamNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->update($request->only([
            'service', 'provider_name', 'date_time', 'agora_way_url'
        ]));

        return response()->json([
            'message' => 'Notification updated successfully',
            'data' => $notification
        ]);
    }

    public function destroy($id)
    {
        $notification = StreamNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }

    
    public function generateToken(Request $req)
    {
        try {
            $privilegeExpiredTs = Carbon::now()->timestamp + 600;
            $rtmTokenController = new RtmTokenBuilder;
            $rtmToken = $rtmTokenController->buildToken($req->appID, $req->appCertificate, $req->user, $privilegeExpiredTs);

            return response()->json([
                'rtmToken' => $rtmToken,
                'status' => 200,
            ], 200);
        } catch (\Exception$e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }

    public function generateRtcToken(Request $req)
    {
        try {
            $privilegeExpiredTs = Carbon::now()->timestamp + 600;
            $rtcTokenController = new RtcTokenBuilder;
            $rtcToken = $rtcTokenController->buildTokenWithUid($req->appID, $req->appCertificate, $req->channelName, $req->user, 1, $privilegeExpiredTs);
            return response()->json([
                'rtcToken' => $rtcToken,
                'status' => 200,
            ], 200);
        } catch (\Exception$e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }
}

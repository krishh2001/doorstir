@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">


       <title>Agora Video Call</title>
    <style>
        #local-player, #remote-player {
            width: 45%;
            height: 300px;
            border: 2px solid #444;
            margin: 10px;
        }
        .video-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        button {
            margin: 20px;
            padding: 10px 20px;
        }
    </style>

    <h2 align="center">Agora Video Call – Channel: </h2>

    <div class="video-container">
        <div id="local-player"></div>
        <div id="remote-player"></div>
    </div>

    <div style="text-align: center;">
        <button onclick="leaveCall()">Leave Call</button>
    </div>

    <script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script>
        const APP_ID = "cb38de2959ec4f0d8aa312cd427dabf3";  // 🔁 Replace this
        const CHANNEL = "My New Project 1";
        const TOKEN = null;

        const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

        let localTracks = [], remoteTracks = {};

        async function joinCall() {
            await client.join(APP_ID, CHANNEL, TOKEN, null);

            localTracks = await AgoraRTC.createMicrophoneAndCameraTracks();

            localTracks[1].play("local-player");

            await client.publish(localTracks);

            client.on("user-published", async (user, mediaType) => {
                await client.subscribe(user, mediaType);
                if (mediaType === "video") {
                    const remotePlayer = document.getElementById("remote-player");
                    remotePlayer.innerHTML = "";
                    user.videoTrack.play("remote-player");
                }
                if (mediaType === "audio") {
                    user.audioTrack.play();
                }
            });
        }

        async function leaveCall() {
            for (track of localTracks) {
                track.stop();
                track.close();
            }
            await client.leave();
            alert("You left the call.");
        }

        joinCall();
    </script>



        <div class="filter-row">
            <div class="search-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"></line>
                </svg>
                <input type="text" placeholder="Search">
            </div>

            <select>
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="resolved">Completed</option>
                <option value="upcomming">Upcomming</option>
            </select>

            <button class="btn-small btn-search">Search</button>




       <!-- <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.20.0.js"></script>

        <h2>Agora Video Call: </h2>
    <div id="video-container">
        <div id="local-player" style="width: 400px; height: 300px; background: #000;"></div>
        <div id="remote-player" style="width: 400px; height: 300px; background: #000;"></div>
    </div>

    <script>
        const appId = "{{ env('AGORA_APP_ID') }}";
        const token = "006cb38de2959ec4f0d8aa312cd427dabf3IAA1wQBx68AQLAIhJQNYfwJKjhEa8Rd+ewW6uLnJi1mRbA2+1RoAAAAAEADkBQEAAslyaAEA6APaeXFo";
        const channel = "My New Project 1";
        const uid = Math.floor(Math.random() * 10000);

        const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

        client.init(appId, () => {
            client.join(token || null, channel, uid, () => {
                const localStream = AgoraRTC.createStream({
                    audio: true,
                    video: true,
                    screen: false,
                });

                localStream.init(() => {
                    localStream.play("local-player");
                    client.publish(localStream);
                });

                client.on("stream-added", (evt) => {
                    const stream = evt.stream;
                    client.subscribe(stream);
                });

                client.on("stream-subscribed", (evt) => {
                    evt.stream.play("remote-player");
                });
            });
        });
    </script> -->


 
    



        </div>

        <div class="support-table-wrapper">
            <table class="support-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Provider Name</th>
                        <th>Date</th>
                        <th>Agora URL</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($streamnotifications as $row)
                    <tr>
                        
                        <td>{{$row->id}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->service->name}}</td>
                        <td>{{$row->provider->name}}</td>
                        <td>{{$row->date_time}}</td>
                        <td>{{$row->agora_way_url}}</td>

                        <td>
                            @if($row->status =='complete')
                            <span class="badge badge-success">Completed</span>
                            @elseif($row->status =='upcoming')
                            <span class="badge upcomming">Upcoming</span>
                            @elseif($row->status =='cancel')
                            <span class="badge" style="background-color:red; color: white;">Cancelled</span>
                            @else
                            <span class="badge badge-info">pending</span>
                            @endif
                        </td>
                        <td>
                             <!-- <button class="btn-small btn-reply" data_id="{{$row->id}}" data_user_id="{{$row->user_id}}" data_user_name="{{$row->user->name}}" data_service="{{$row->service_id}}" data_service_name="{{$row->service->name}}"  onclick="openModal()">Create Stream</button> -->
                            <button class="btn-small btnn-delete" onclick="openSliderModal('delete')">Delete</button>
                            <!-- <button class="btn-small btnn-primary" onclick="joinUserMeeting()">Join Meeting</button> -->
                             <input type="text" id="linkLink" placeholder="Enter meeting link" value="{{$row->agora_way_url}}">
<button onclick="joinUserMeeting()">Join Meeting</button>

                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="slider-modal-overlay" id="sliderDeleteModal" style="display:none;">
        <div class="slider-modal">
            <button class="user-delete-close" onclick="closeSliderModals()">×</button>
            <div class="slider-modal-delete-header">Confirm Delete</div>
            <p style="text-align:center;">Are you sure you want to delete this?</p>
            <div class="slider-modal-actions centered">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>

    {{-- Create Stream Modal --}}
  


    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script>
function joinUserMeeting() {
    var link = $('#linkLink').val();

    if (link.trim() === '' || link.length < 1) {
        alert('Please enter the link');
        return;
    } else {
        window.open(link, '_blank');
    }
}
</script>


    <script>
    function openModal(button) {
        const userId = button.getAttribute('data-user-id');
        const username = button.getAttribute('data-user-name');
        const serviceId = button.getAttribute('data-service');
        const servicename = button.getAttribute('data-service-name');
        // const dateTime = button.getAttribute('data-date-time');

        // Populate modal fields
        document.getElementById('userIdField').value = userId;
        document.getElementById('user_name').value = username;
        document.getElementById('serviceField').value = serviceId;
        document.getElementById('servicename').value = servicename;
        // document.getElementById('datetimeField').value = dateTime;

        // Show the modal
        document.getElementById('replyModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('replyModal').style.display = 'none';
    }

    function toggleStreamLinkInput() {
        const selected = document.getElementById('streamWay').value;
        document.getElementById('streamLinkGroup').classList.toggle('hidden', !selected);
    }
</script>

@endsection

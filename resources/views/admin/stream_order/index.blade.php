@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">
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
        </div>

        <div class="support-table-wrapper">
            <table class="support-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($streamOrder as $row)
                    <tr>
                        <td>1</td>
                        <td>{{$row->order_id}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->service->name}}</td>
                        <td>{{$row->date_time}}</td>

                        <td>
                            @if($row->status =='complete')
                            <span class="badge badge-success">Completed</span>
                            @elseif($row->status =='upcoming')
                            <span class="badge upcomming">Upcoming</span>
                            @else
                            <span class="badge badge-info">pending</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn-small btn-reply" data-id="{{ $row->id }}" data-user-id="{{ $row->user_id }}" data-user-name="{{ $row->user->name }}" data-service="{{ $row->service_id }}" data-service-name="{{ $row->service->name }}" data-date-time="{{ $row->date_time ?? '' }}" onclick="openModal(this)">Create Stream</button>
                            <!-- <button class="btn-small btn-reply" data_id="{{$row->id}}" data_user_id="{{$row->user_id}}" data_user_name="{{$row->user->name}}" data_service="{{$row->service_id}}" data_service_name="{{$row->service->name}}"  onclick="openModal()">Create Stream</button> -->
                            <button class="btn-small btnn-delete" onclick="openSliderModal('delete')">Delete</button>
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
    <div class="modal" id="replyModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">×</button>
            <h3>Send Stream Details</h3>
            <form action="{{route('admin.stream.create')}}" method="POST">
               
            @csrf
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" id="user_name">
                    <input type="hidden" id="userIdField" name="user_id" readonly>
                </div>

                <div class="form-group">
                    <label>Service</label>
                    <input type="text" id="servicename" readonly>
                    <input type="hidden" id="serviceField" name="service_id"  readonly>
                </div>

                <div class="form-group">
                    <label>Provider Name</label>
                    <select name="provider_id" id="providerField">
                        @foreach($ServiceProvider as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                     </div>

                <div class="form-group">
                    <label>Date & Time</label>
                    <!-- <input type="date"  name="datetime"> -->
                    <input type="datetime-local" id="datetime" name="date_time" required>

                </div>

                <div class="form-group">
                    <label>Stream Way Name</label>
                    <select id="streamWay" onchange="toggleStreamLinkInput()" required>
                        <option value="">-- Select Platform --</option>
                        <option value="zoom">Zoom</option>
                        <option value="google_meet">Google Meet</option>
                        <option value="microsoft_teams">Microsoft Teams</option>
                        <option value="skype">Skype</option>
                    </select>
                </div>

                <div class="form-group hidden" id="streamLinkGroup">
                    <label>Stream Link</label>
                    <input type="url" id="streamLinkInput" name="agora_way_url" placeholder="Paste the meeting link here">
                </div>

                <button class="btn-small btn-reply" type="submit">Send</button>
            </form>
        </div>

        <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.20.0.js"></script>
<script>
  const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

  client.init("cb38de2959ec4f0d8aa312cd427dabf3", () => {
    console.log("AgoraRTC client initialized");
    // join, create stream, publish, etc.
  });
</script>


    </div>

    <!-- <script>
        function openModal(userId = '', service = '', dateTime = '') {
            document.getElementById('userIdField').value = user_id;
            // document.getElementById('userIdField').value = user_name;
            document.getElementById('serviceField').value = service_id;
            // document.getElementById('serviceField').value = service_name;
            document.getElementById('datetimeField').value = dateTime;
            document.getElementById('replyModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('replyModal').style.display = 'none';
        }

        function toggleStreamLinkInput() {
            const selected = document.getElementById('streamWay').value;
            document.getElementById('streamLinkGroup').classList.toggle('hidden', !selected);
        }
    </script> -->

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

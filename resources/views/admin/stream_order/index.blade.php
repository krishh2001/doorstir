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
                    <tr>
                        <td>1</td>
                        <td>#ORD12345</td>
                        <td>Ravi Sharma</td>
                        <td>AC Repair</td>
                        <td>2025-06-25</td>
                        <td><span class="badge badge-success">Completed</span></td>
                        <td>
                            <button class="btn-small btn-reply" onclick="openModal()">Create Stream</button>
                            <button class="btn-small btnn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>#ORD12346</td>
                        <td>Anjali Mehra</td>
                        <td>Electrician</td>
                        <td>2025-06-27</td>
                        <td><span class="badge badge-info">Pending</span></td>
                        <td>
                            <button class="btn-small btn-reply" onclick="openModal()">Create Stream</button>
                            <button class="btn-small btnn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>#ORD12346</td>
                        <td>Anjali Mehra</td>
                        <td>Electrician</td>
                        <td>2025-06-27</td>
                        <td>
                            <span class="badge upcomming">Upcoming</span>
                        </td>
                        <td>
                            <button class="btn-small btn-reply" onclick="openModal()">Create Stream</button>
                            <button class="btn-small btnn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </td>
                    </tr>
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
            <form id="streamForm">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" id="userIdField" readonly>
                </div>

                <div class="form-group">
                    <label>Service</label>
                    <input type="text" id="serviceField" readonly>
                </div>

                <div class="form-group">
                    <label>Provider Name</label>
                    <input type="text" id="providerField" placeholder="Enter provider name">
                </div>

                <div class="form-group">
                    <label>Date & Time</label>
                    <input type="text" id="datetimeField" readonly>
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
                    <input type="url" id="streamLinkInput" placeholder="Paste the meeting link here">
                </div>

                <button class="btn-small btn-reply" type="submit">Send</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(userId = '', service = '', dateTime = '') {
            document.getElementById('userIdField').value = userId;
            document.getElementById('serviceField').value = service;
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
    </script>
@endsection

@extends('admin.layouts.admin')

@section('content')
   
    <div class="user-dashboard">
        <!-- Filters -->
        <!--<div class="filter-row">-->
        <!--    <div class="search-wrapper">-->
        <!--        <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"-->
        <!--            stroke="currentColor">-->
        <!--            <circle cx="11" cy="11" r="8" stroke-width="2"></circle>-->
        <!--            <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"></line>-->
        <!--        </svg>-->
        <!--        <input type="text" placeholder="Search by User">-->
        <!--    </div>-->

        <!--    <input type="date" class="filter-date">-->

        <!--    <select>-->
        <!--        <option value="">All Status</option>-->
        <!--        <option value="pending">Pending</option>-->
        <!--        <option value="resolved">Resolved</option>-->
        <!--    </select>-->

        <!--    <button class="btn-small btn-search">Search</button>-->
        <!--</div>-->


        <!-- Tickets Table -->
        <div class="support-table-wrapper">
            <table class="support-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>Login Issue</td>
                        <td>Unable to reset password and login.</td>
                        <td>2025-06-18</td>
                        <td>
                            <button class="btn-small btn-resolve">Resolve</button>
                            <a href="{{ route('admin.supports.view') }}" class="btn-small btn-view">View</a>
                            <!--<button class="btn-small btn-reply" onclick="openModal()">Reply</button>-->
                            <button class="btn-small btn-delete" onclick="openSliderModal('delete')">Delete</button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>


     {{-- Delete Modal --}}
    <div class="slider-modal-overlay" id="sliderDeleteModal">
        <div class="slider-modal">
            <button class="user-delete-close" onclick="closeSliderModals()">×</button>
            <div class="slider-modal-delete-header">Confirm Delete</div>
            <p style="text-align:center;">Are you sure you want to delete this ?</p>
            <div class="slider-modal-actions centered">
                <button class="slider-btn-cancel" onclick="closeSliderModals()">Cancel</button>
                <button class="slider-btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
    <!-- Reply Modal -->
    <div class="modal" id="replyModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">×</button>
            <h3>Reply</h3>
            <form>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="user@example.com" readonly>
                </div>
                <div class="form-group">
                    <label>Reply Message</label>
                    <textarea rows="4" placeholder="Write your reply..."></textarea>
                </div>
                <button class="btn-small btn-reply" type="submit">Send Reply</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('replyModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('replyModal').style.display = 'none';
        }
    </script>
@endsection

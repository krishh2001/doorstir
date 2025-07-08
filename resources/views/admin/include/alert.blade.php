@if (session('success'))
    <div id="alert-success" class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="alert-error" class="alert alert-danger">
        <i class="fas fa-times-circle"></i>
        {{ session('error') }}
    </div>
@endif


<script>
    // Function to hide alert messages after 3 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('alert-success');
        const errorAlert = document.getElementById('alert-error');

        // Fade out success alert
        if (successAlert) {
            successAlert.classList.add('fade-out');
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 600); // Wait for fade-out to complete
        }

        // Fade out error alert
        if (errorAlert) {
            errorAlert.classList.add('fade-out');
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 600); // Wait for fade-out to complete
        }
    }, 3000); // Keep messages visible for 3 seconds before starting fade-out
</script>


<style>
    /* i Icon styling */
    .alert i {
        margin-right: 8px;
        font-size: 1.2em;
    }

    /* Alert box common styling */
    .alert {
        position: fixed;
        top: 25px;
        left: 45%;
        transform: translateX(-50%);
        padding: 12px 25px;
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
        border-radius: 10px 25px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        opacity: 0;
        /* Start hidden for animation */
        transition: opacity 0.6s ease, transform 0.6s ease;
        animation: slideIn 0.6s ease-out forwards;
    }

    /* Success Alert */
    .alert-success {
        background-color: #058f25;
        color: white;
    }

    .alert-success i {
        color: #fff;
    }

    /* Error Alert */
    .alert-danger {
        background-color: #b40012;
        color: white;
    }

    .alert-danger i {
        color: #fff;
    }

    /* Slide In animation */
    @keyframes slideIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
            /* Start slightly above */
        }

        100% {
            opacity: 1;
            transform: translateY(0);
            /* End in the correct position */
        }
    }

    /* Fade-out effect */
    .fade-out {
        animation: fadeOut 0.6s ease forwards;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: translateY(0);
            /* Keep the alert centered */
        }

        100% {
            opacity: 0;
            transform: translateY(20px);
            /* Move down gently during fade-out */
        }
    }
</style>

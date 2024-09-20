<link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    function showConfirmationDialog(title, text, confirmButtonText, callback) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }

    function confirmDelete(userId) {
        showConfirmationDialog(
            'Are you sure?',
            'You won\'t be able to revert this!',
            'Yes, delete it!',
            function() {
                document.getElementById('delete-form-' + userId).submit();
            },
        );
    }

    function confirmCreate(event) {
        event.preventDefault();
        showConfirmationDialog(
            'Are you sure?',
            'You won\'t be able to revert this!',
            'Yes, create it!',
            function() {
                document.getElementById('create-form').submit();
            },
        );
    }

    function confirmUpdate(event, userId) {
        event.preventDefault();
        showConfirmationDialog(
            'Are you sure?',
            'You won\'t be able to revert this!',
            'Yes, update it!',
            function() {
                document.getElementById('update-form-' + userId).submit();
            },
        );
    }
</script>

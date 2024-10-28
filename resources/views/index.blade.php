<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Guest Login</h1>
    
    <form id="guestLoginForm">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="button" onclick="guestLogin()">Login as Guest</button>
    </form>

    <script>
        function guestLogin() {
            const name = document.getElementById('name').value;

            if (!name) {
                alert('Please enter your name.');
                return;
            }

            fetch("{{ route('guest.login.post') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ name: name })
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    // Store token and name in localStorage
                    localStorage.setItem('guestToken', data.token);
                    localStorage.setItem('guestName', data.name);
                    alert('Guest login successful!');
                    window.location.href = `/dashboard?token=${data.token}`;
                } else {
                    alert('Login failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>

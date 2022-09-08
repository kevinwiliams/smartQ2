<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    // messagesElement = document.getElementById('messages');
    // tokenElement = document.getElementById('token');
    // errorElement = document.getElementById('error');

    var config = {
        apiKey: "{{ config('larafirebase.api_key') }}",
        authDomain: "{{ config('larafirebase.authDomain') }}",
        projectId: "{{ config('larafirebase.projectId') }}",
        storageBucket: "{{ config('larafirebase.storageBucket') }}",
        messagingSenderId: "{{ config('larafirebase.messagingSenderId') }}",
        appId: "{{ config('larafirebase.appId') }}",
        measurementId: "{{ config('larafirebase.measurementId') }}"
    };
    firebase.initializeApp(config);
    var _requestPerm = '{{ auth()->user()->getRefreshToken() }}';
    $(function() {

        console.log(_requestPerm);
        if (_requestPerm == 1) {
            initFirebaseMessagingRegistration();
        }
    });

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission()
            .then(function() {
                console.log('Notification permission granted.');

                return messaging.getToken()
            })
            .then(function(token) {
                // tokenElement.innerHTML = token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save-push-notification-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        // alert('Token saved successfully.');
                        // if (_requestPerm == 0) {
                        //     Swal.fire({
                        //         title: "Notifications",
                        //         text: "Notifications successfully enabled",
                        //         icon: 'success',
                        //         buttonsStyling: false,
                        //         customClass: {
                        //             confirmButton: "btn btn-light"
                        //         }
                        //     });
                        //     $("#btn-nft-enable").hide();
                        // }
                    },
                    error: function(err) {
                        console.log('Notification Token Error' + err);
                    },
                });
            })
            .catch(function(err) {
                // errorElement.innerHTML = err
                console.log('Unable to get permission to notify.', err);
            });
    }

    messaging.onMessage((payload) => {
        console.log('Message received. ', payload);
        // appendMessage(payload);
        Swal.fire({
            title: payload.notification.title,
            text: payload.notification.body,
            icon: 'info',
            buttonsStyling: false,
            customClass: {
                confirmButton: "btn btn-light"
            }
        });
    });

    function appendMessage(payload) {
        const messagesElement = document.querySelector('#messages');
        const dataHeaderElement = document.createElement('h5');
        const dataElement = document.createElement('pre');
        dataElement.style = 'overflow-x:hidden;';
        dataHeaderElement.textContent = 'Received message:';
        dataElement.textContent = JSON.stringify(payload, null, 2);
        messagesElement.appendChild(dataHeaderElement);
        messagesElement.appendChild(dataElement);
    }
</script>
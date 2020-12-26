<!-- firebase integration started -->
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-analytics.js"></script>
<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-functions.js"></script>

<!-- firebase integration end -->
<!-- <script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyD2gjUNFB6lmDx4qWHZUrlFpmbT3lTkY3Q",
    authDomain: "web-notification-2480c.firebaseapp.com",
    databaseURL: "https://web-notification-2480c.firebaseio.com",
    projectId: "web-notification-2480c",
    storageBucket: "web-notification-2480c.appspot.com",
    messagingSenderId: "411648972177",
    appId: "1:411648972177:web:88cfbbc7d01c61ee377630",
    measurementId: "G-6SE4VXSFGZ"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  //firebase.analytics();
</script> -->

<script>
  // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDm2VneSfR3H_6_RjGMoHQfMNLUo4HLU-4",
        authDomain: "mawad-test-4f5f6.firebaseapp.com",
        databaseURL: "https://mawad-test-4f5f6.firebaseio.com",
        projectId: "mawad-test-4f5f6",
        storageBucket: "mawad-test-4f5f6.appspot.com",
        messagingSenderId: "431132758481",
        appId: "1:431132758481:web:a5bd5e8aa9af4e5d05d0f0",
        measurementId: "G-W5KPZ13GFG"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();

   const messaging = firebase.messaging();
    messaging
   .requestPermission()
   .then(function () {
        //MsgElem.innerHTML = "Notification permission granted." 
        console.log("Notification permission granted.");
         // get the token in the form of promise
        return messaging.getToken()
    })
    .then(function(token) {
        // print the token on the HTML page     
        console.log("token ======= ",token);
        $.ajax({
            url: "{{url('registerToken')}}",
            type: 'POST',
            data:{'token' :token},
            // data:{_token: "{{csrf_token()}}"},
            success: function (data) {
                if (data.status=='success') {
                    console.log("success ============ ");                    
                }
            }
        });
    })
    .catch(function (err) {
        console.log("Unable to get permission to notify.", err);
    });

    messaging.onMessage(function(payload) {
        console.log(payload);
        var notify;
        notify = new Notification(payload.notification.title,{
            body: payload.notification.body,
            icon: payload.notification.icon,
            tag: "Dummy"
        });
        console.log(payload.notification);
    });

    //     //firebase.initializeApp(config);
    // var database = firebase.database().ref().child("/users/");
       
    // database.on('value', function(snapshot) {
    //     renderUI(snapshot.val());
    // });

    // // On child added to db
    // database.on('child_added', function(data) {
    //     console.log("Comming");
    //     if(Notification.permission!=='default'){
    //         var notify;
             
    //         notify= new Notification('CodeWife - '+data.val().username,{
    //             'body': data.val().message,
    //             'icon': 'bell.png',
    //             'tag': data.getKey()
    //         });
    //         notify.onclick = function(){
    //             alert(this.tag);
    //         }
    //     }else{
    //         alert('Please allow the notification first');
    //     }
    // });

    // self.addEventListener('notificationclick', function(event) {       
    //     event.notification.close();
    // });
</script>
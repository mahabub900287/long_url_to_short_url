importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyD8i-7HrM1cCn6qXfVBAq58km-1z-le-54",
    authDomain: "virtunus-todo.firebaseapp.com",
    databaseURL: "https://virtunus-todo-default-rtdb.firebaseio.com",
    projectId: "virtunus-todo",
    storageBucket: "virtunus-todo.appspot.com",
    messagingSenderId: "618046938393",
    appId: "1:618046938393:web:f244e403382427ca7ef988",
    measurementId: "G-19GYW0ZFXM"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});

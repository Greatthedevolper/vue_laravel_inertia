// src/firebase.js or resources/js/firebase.js
import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';

const firebaseConfig = {
    apiKey: "AIzaSyC_vxSuLnDDWbJDOiP6aDWw334mVY5ZdG8",
    authDomain: "laravel-inertia-996f5.firebaseapp.com",
    databaseURL: "https://laravel-inertia-996f5-default-rtdb.firebaseio.com",
    projectId: "laravel-inertia-996f5",
    storageBucket: "laravel-inertia-996f5.appspot.com",
    messagingSenderId: "19479149469",
    appId: "1:19479149469:web:9e8c55201fb278173d0d74",
    measurementId: "G-D62FGQ4QBT"
  };

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

export { auth };

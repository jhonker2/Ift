// Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.3.1/firebase-app.js";
import { getDatabase, ref, onValue, set } from "https://www.gstatic.com/firebasejs/10.3.1/firebase-database.js";

const firebaseConfig = {
    apiKey: "AIzaSyCa5nBPDA0B4PX-Iwm4ZivrITe41WIzO3E",
    authDomain: "portoaguas-cab7f.firebaseapp.com",
    projectId: "portoaguas-cab7f",
    storageBucket: "portoaguas-cab7f.appspot.com",
    messagingSenderId: "309375367318",
    appId: "1:309375367318:web:da2b495218d9fd3cd8eab7",
    measurementId: "G-VEWPRBKXVB"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

// Google Maps
let map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -1.038224, lng: -80.493740},
        zoom: 13
    });

    // Geolocalización
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map.setCenter(pos);
        }, function() {
            // Manejar errores aquí
        });
    } else {
        // El navegador no soporta geolocalización
    }

    // Escuchar cambios en la ubicación de los usuarios
    const usersRef = ref(db, 'users/');
    onValue(usersRef, (snapshot) => {
        const users = snapshot.val();
        for (let userId in users) {
            const user = users[userId];
            const marker = new google.maps.Marker({
                position: {lat: user.latitude, lng: user.longitude},
                map: map,
                icon: createCustomMarker(user.iconURL)
            });

            const popupContent = `
                <strong>IdUsuario:</strong> ${user.IdUsuario}<br>
                <strong>Nombre:</strong> ${user.Nombre}<br>
                <strong>Nivel de Batería:</strong> ${user.NivelBateria}<br>
                <strong>Fecha:</strong> ${user.Fecha}
            `;

            const infowindow = new google.maps.InfoWindow({
                content: popupContent
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
    });
}

function createCustomMarker(iconURL) {
    return {
        url: iconURL,
        scaledSize: new google.maps.Size(52, 52)
    };
}

function updateUserLocation(userId, latitude, longitude, iconURL, IdUsuario, Nombre, NivelBateria, Fecha) {
    const userRef = ref(db, 'users/' + userId);
    set(userRef, {
        latitude: latitude,
        longitude: longitude,
        iconURL: iconURL,
        IdUsuario: IdUsuario,
        Nombre: Nombre,
        NivelBateria: NivelBateria,
        Fecha: Fecha
    });
}

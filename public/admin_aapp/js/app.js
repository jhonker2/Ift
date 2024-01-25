
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.3.1/firebase-app.js";
import { getDatabase, ref, onValue, set } from "https://www.gstatic.com/firebasejs/10.3.1/firebase-database.js";




const markers = {};  // Objeto para almacenar los marcadores existentes

const firebaseConfig = {
    apiKey: "AIzaSyCa5nBPDA0B4PX-Iwm4ZivrITe41WIzO3E",
    authDomain: "portoaguas-cab7f.firebaseapp.com",
    projectId: "portoaguas-cab7f",
    storageBucket: "portoaguas-cab7f.appspot.com",
    messagingSenderId: "309375367318",
    appId: "1:309375367318:web:da2b495218d9fd3cd8eab7",
    measurementId: "G-VEWPRBKXVB"
};

// Inicializa Firebase y la base de datos
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

mapboxgl.accessToken = 'pk.eyJ1IjoicG9ydG9hZ3Vhc2VwIiwiYSI6ImNscWdvYjdzbTFjcmIycXBhd2QzdmMyd2QifQ.ydlniQ9GaHJornYg4nytog';
const map = new mapboxgl.Map({
    container: 'map',
	style: 'mapbox://styles/portoaguasep/clm77uezc02mt01qbbn1jhjbt',
    center: [-80.493740, -1.038224],
    zoom: 16
});



// Escucha cambios en la ubicación de los usuarios
const usersRef = ref(db, 'users/');
onValue(usersRef, (snapshot) => {
    const users = snapshot.val();
    for (let userId in users) {
        const user = users[userId];
        if (markers[userId]) {
            // Si el marcador ya existe, actualiza su posición
            markers[userId].setLngLat([user.longitude, user.latitude]);
        } else {
            // Si el marcador no existe, crea uno nuevo
            const marker = new mapboxgl.Marker({
                element: createCustomMarker(user.iconURL) // Usamos un marcador personalizado
            })
            .setLngLat([user.longitude, user.latitude])
            .addTo(map);

            // Agregar un popup al marcador que muestra la información del usuario
            const popupContent = `
                <strong>IdUsuario:</strong> ${user.IdUsuario}<br>
                <strong>Nombre:</strong> ${user.Nombre}<br>
                <strong>Nivel de Batería:</strong> ${user.NivelBateria}<br>
                <strong>Fecha:</strong> ${user.Fecha}
            `;

            const popup = new mapboxgl.Popup({ offset: 25 })
            .setHTML(popupContent);
            
            marker.setPopup(popup);

            // Almacena el marcador en el objeto markers
            markers[userId] = marker;
        }
    }
});


// ... (resto del código)


// Función para crear un marcador personalizado
function createCustomMarker(iconURL) {
    const el = document.createElement('div');
    el.style.backgroundImage = `url(${iconURL})`; // Usamos el icono específico del usuario
    el.style.width = '52px'; 
    el.style.height = '52px';
    el.style.backgroundSize = 'cover';
    return el;
}

// ... (resto del código anterior)

// Función para actualizar la ubicación de un usuario
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




const geolocate = new mapboxgl.GeolocateControl({
    positionOptions: {
        enableHighAccuracy: true
    },
    trackUserLocation: true,
    showUserLocation: true, // Asegúrate de que esta opción esté habilitada
    circleStyle: {
        radius: 20, // Ajusta este valor para controlar el tamaño del círculo (en píxeles)
        color: 'red' // Cambia el color del círculo a rojo
    }
});

map.addControl(geolocate);

// Iniciar la geolocalización al cargar el mapa
map.on('load', function() {
    geolocate.trigger();
});

